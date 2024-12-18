<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonTimetableController;
use App\Http\Controllers\MonthlyPaymentController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\StudentArchievementController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentGuardianController;
use App\Http\Controllers\StudentMisconductController;
use App\Http\Controllers\StudentReportController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherPicketController;
use App\Http\Controllers\TeacherPresenceController;
use App\Http\Controllers\TimeController;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::get("/", function () {
        return view("pages.welcome");
    });

    Route::get("/login", [AuthController::class, 'loginPage'])->name("login");
    Route::post("/login", [AuthController::class, "loginProses"])->name("login.proses");
    Route::get("/register", [AuthController::class, "registerPage"])->name("register");
    Route::post("/register", [AuthController::class, "registerProses"])->name("register.proses");
    Route::get("forgot-password", [ResetPasswordController::class, "forgotPage"])->name("password.request");
    Route::post("forgot-password", [ResetPasswordController::class, "forgotPassword"])->name("password.email");
    Route::get("reset-password/{token}", [ResetPasswordController::class, "resetPage"])->name("password.reset");
    Route::post("reset-password", [ResetPasswordController::class, "resetPassword"])->name("password.update");
});

Route::middleware("auth")->group(function () {
    Route::get("email-verify", [EmailVerifyController::class, 'verify'])->name('verification.notice');
    Route::post("email-verify/resend", [EmailVerifyController::class, 'resendVerify'])->name("resend-verify");

    Route::get("/email/verify/{id}/{hash}", [EmailVerifyController::class, 'emailVerify'])->middleware('signed')->name('verification.verify');
});

Route::middleware(["auth", "auth.session", "verified"])->group(function () {
    Route::prefix("super-admin")->name("sa.")->middleware("role:super_admin")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');

        Route::resource("student", StudentController::class);
        Route::resource("student-guardian", StudentGuardianController::class);
        Route::resource("monthly-payment", MonthlyPaymentController::class)->only('index');

        Route::get("achievement/{id}/student/{studentId}", [StudentArchievementController::class, 'editFromAdmin'])->name("student-achievement.edit");
        Route::patch("achievement/{id}/student/{studentId}", [StudentArchievementController::class, 'updateFromAdmin'])->name("student-achievement.update");

        Route::get("misconduct/{id}/student/{studentId}", [StudentArchievementController::class, 'editFromAdmin'])->name("student-misconduct.edit");
        Route::patch("misconduct/{id}/student/{studentId}", [StudentArchievementController::class, 'updateFromAdmin'])->name("student-misconduct.update");


        Route::resource("teacher", TeacherController::class)->only(['index', 'edit', 'update']);
        Route::resource("teacher-picket", TeacherPicketController::class);
        Route::resource("teacher-presence", TeacherPresenceController::class)->only(['index', 'show']);

        Route::resource("class-room", ClassRoomController::class)->except("show");
        Route::resource("lesson", LessonController::class);
        Route::resource("time", TimeController::class)->except('show');
        Route::resource("lesson-timetable", LessonTimetableController::class);
        Route::resource("archive", ArchiveController::class)->only('index');

        Route::prefix("profile/")->group(function () {
            Route::get("{id}/edit", [AccountController::class, "profile"])->name("profile");
            Route::put("{id}/update", [AccountController::class, "updateProfile"])->name("profile.update-image");
            Route::patch("{id}/update", [AccountController::class, "updateAccount"])->name("profile.update-account");
            Route::get("{id}/password", [AccountController::class, "password"])->name("password");
            Route::put("{id}/password", [AccountController::class, "updatePassword"])->name("password.update");
        });
    });

    Route::resource("archive", ArchiveController::class)->only('store');
    Route::get("monthly-payment/export", [MonthlyPaymentController::class, 'export'])->name('monthly-payment.export');
    Route::get("teacher-presence/export", [TeacherPresenceController::class, 'export'])->name('teacher-presence.export');

    Route::prefix("admin")->name("admin.")->middleware("role:admin")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');

        Route::resource("student", StudentController::class);
        Route::resource("student-guardian", StudentGuardianController::class);
        Route::resource("monthly-payment", MonthlyPaymentController::class);

        Route::get("achievement/{id}/student/{studentId}", [StudentArchievementController::class, 'editFromAdmin'])->name("student-achievement.edit");
        Route::patch("achievement/{id}/student/{studentId}", [StudentArchievementController::class, 'updateFromAdmin'])->name("student-achievement.update");

        Route::get("misconduct/{id}/student/{studentId}", [StudentMisconductController::class, 'editFromAdmin'])->name("student-misconduct.edit");
        Route::patch("misconduct/{id}/student/{studentId}", [StudentMisconductController::class, 'updateFromAdmin'])->name("student-misconduct.update");

        Route::resource("teacher", TeacherController::class)->only(['index', 'edit', 'update']);
        Route::resource("teacher-picket", TeacherPicketController::class);
        Route::resource("teacher-presence", TeacherPresenceController::class)->except(['create', 'store', 'destroy']);

        Route::resource("class-room", ClassRoomController::class)->except("show");
        Route::resource("lesson", LessonController::class);
        Route::resource("time", TimeController::class)->except('show');
        Route::resource("lesson-timetable", LessonTimetableController::class);
        Route::resource("archive", ArchiveController::class)->only(['index', 'destroy']);

        Route::prefix("profile/")->group(function () {
            Route::get("{id}/edit", [AccountController::class, "profile"])->name("profile");
            Route::put("{id}/update", [AccountController::class, "updateProfile"])->name("profile.update-image");
            Route::patch("{id}/update", [AccountController::class, "updateAccount"])->name("profile.update-account");
            Route::get("{id}/password", [AccountController::class, "password"])->name("password");
            Route::put("{id}/password", [AccountController::class, "updatePassword"])->name("password.update");
        });
    });

    Route::prefix("operator")->name("operator.")->middleware("role:operator")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');

        Route::resource("student", StudentController::class);
        Route::resource("teacher", TeacherController::class)->only('index');
        Route::resource("teacher-picket", TeacherPicketController::class)->only('index');

        Route::resource("class-room", ClassRoomController::class)->except("show");
        Route::resource("lesson", LessonController::class)->except('show');
        Route::resource("time", TimeController::class)->except('show');
        Route::resource("lesson-timetable", LessonTimetableController::class);
        Route::resource("archive", ArchiveController::class)->only(['index', 'destroy']);

        Route::prefix("profile/")->group(function () {
            Route::get("{id}/edit", [AccountController::class, "profile"])->name("profile");
            Route::put("{id}/update", [AccountController::class, "updateProfile"])->name("profile.update-image");
            Route::patch("{id}/update", [AccountController::class, "updateAccount"])->name("profile.update-account");
            Route::delete("{id}/delete", [AccountController::class, "deleteAccount"])->name("profile.delete");
            Route::get("{id}/password", [AccountController::class, "password"])->name("password");
            Route::put("{id}/password", [AccountController::class, "updatePassword"])->name("password.update");
        });
    });

    Route::prefix("teacher")->name("teacher.")->middleware("role:teacher")->group(function () {
        Route::get("dashboard", [DashboardController::class, "index"])->name("dashboard");

        Route::resource("student-achievement", StudentArchievementController::class);
        Route::resource("student-misconduct", StudentMisconductController::class);

        Route::resource("teacher-presence", TeacherPresenceController::class);
        Route::resource("student-report", StudentReportController::class)->except('show');
        Route::resource("archive", ArchiveController::class)->only(['index', 'destroy']);

        Route::prefix("profile/")->group(function () {
            Route::get("{id}/edit", [AccountController::class, "profile"])->name("profile");
            Route::put("{id}/update", [AccountController::class, "updateProfile"])->name("profile.update-image");
            Route::patch("{id}/update", [AccountController::class, "updateAccount"])->name("profile.update-account");
            Route::get("{id}/password", [AccountController::class, "password"])->name("password");
            Route::put("{id}/password", [AccountController::class, "updatePassword"])->name("password.update");
            Route::delete("{id}/delete", [AccountController::class, "deleteAccount"])->name("profile.delete");
        });
    });

    Route::post("/logout", [AuthController::class, 'logout'])->name("logout");
});
