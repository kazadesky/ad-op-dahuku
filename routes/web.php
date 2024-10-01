<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonTimetableController;
use App\Http\Controllers\MonthlyPaymentController;
use App\Http\Controllers\StudentArchievementController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentGuardianController;
use App\Http\Controllers\StudentMisconductController;
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
    Route::get("forgot-password", "ResetPasswordController@forgotPage")->name("forgot.page");
    Route::post("forgot-password", "ResetPasswordController@forgotPassword")->name("forgot.password");
    Route::get("reset-password/{token}", "ResetPasswordController@resetPage")->name("reset.page");
    Route::post("reset-password", "ResetPasswordController@resetPassword")->name("reset.password");
});

Route::middleware("auth")->group(function () {
    Route::get("email-verify", 'EmailVerifyController@verify')->name('email-verify');
    Route::post("email-verify/resend", "EmailVerifyController@resendVerify")->name("resend-verify");
});

Route::middleware(["auth", "auth.session", "verified"])->group(function () {
    Route::prefix("super-admin")->name("sa.")->middleware("role:super_admin")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');

        Route::patch("teacher-picket/{id}/action", [TeacherPicketController::class, 'action'])->name("teacher-picket.action");

        Route::resource("student", StudentController::class);
        Route::resource("student-guardian", StudentGuardianController::class);
        Route::resource("monthly-payment", MonthlyPaymentController::class);

        Route::get("achievement/{id}/student/{studentId}", [StudentArchievementController::class, 'editFromAdmin'])->name("student-achievement.edit");
        Route::patch("achievement/{id}/student/{studentId}", [StudentArchievementController::class, 'updateFromAdmin'])->name("student-achievement.update");

        Route::get("misconduct/{id}/student/{studentId}", [StudentArchievementController::class, 'editFromAdmin'])->name("student-misconduct.edit");
        Route::patch("misconduct/{id}/student/{studentId}", [StudentArchievementController::class, 'updateFromAdmin'])->name("student-misconduct.update");


        Route::resource("teacher", TeacherController::class)->only(['index', 'edit', 'update']);
        Route::resource("teacher-picket", TeacherPicketController::class);
        Route::resource("teacher-presence", TeacherPresenceController::class);

        Route::resource("class-room", ClassRoomController::class)->except("show");
        Route::resource("lesson", LessonController::class);
        Route::resource("time", TimeController::class)->except('show');
        Route::resource("lesson-timetable", LessonTimetableController::class);
        Route::resource("archive", ArchiveController::class)->only(['index', 'post', 'delete']);

        Route::prefix("profile/")->group(function () {
            Route::get("{id}/edit", [AccountController::class, "profile"])->name("profile");
            Route::put("{id}/update", [AccountController::class, "updateProfile"])->name("profile.update-image");
            Route::patch("{id}/update", [AccountController::class, "updateAccount"])->name("profile.update-account");
            Route::delete("{id}/delete", [AccountController::class, "deleteAccount"])->name("profile.delete");
        });
    });

    Route::prefix("admin")->name("admin.")->middleware("role:admin")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');
        Route::patch("teacher-picket/{id}/action", [TeacherPicketController::class, 'action'])->name("teacher-picket.action");

        Route::resource("student", StudentController::class);
        Route::resource("student-guardian", StudentGuardianController::class);
        Route::resource("monthly-payment", MonthlyPaymentController::class);

        Route::get("achievement/{id}/student/{studentId}", [StudentArchievementController::class, 'editFromAdmin'])->name("student-achievement.edit");
        Route::patch("achievement/{id}/student/{studentId}", [StudentArchievementController::class, 'updateFromAdmin'])->name("student-achievement.update");

        Route::get("misconduct/{id}/student/{studentId}", [StudentMisconductController::class, 'editFromAdmin'])->name("student-misconduct.edit");
        Route::patch("misconduct/{id}/student/{studentId}", [StudentMisconductController::class, 'updateFromAdmin'])->name("student-misconduct.update");


        Route::resource("teacher", TeacherController::class)->only(['index', 'edit', 'update']);
        Route::resource("teacher-picket", TeacherPicketController::class);
        Route::resource("teacher-presence", TeacherPresenceController::class);

        Route::resource("class-room", ClassRoomController::class)->except("show");
        Route::resource("lesson", LessonController::class);
        Route::resource("time", TimeController::class)->except('show');
        Route::resource("lesson-timetable", LessonTimetableController::class);
        Route::resource("archive", ArchiveController::class)->only(['index', 'post', 'delete']);

        Route::prefix("profile/")->group(function () {
            Route::get("{id}/edit", [AccountController::class, "profile"])->name("profile");
            Route::put("{id}/update", [AccountController::class, "updateProfile"])->name("profile.update-image");
            Route::patch("{id}/update", [AccountController::class, "updateAccount"])->name("profile.update-account");
            Route::delete("{id}/delete", [AccountController::class, "deleteAccount"])->name("profile.delete");
        });
    });

    Route::prefix("operator")->name("operator.")->middleware("role:operator")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');

        Route::patch("teacher-picket/{id}/action", [TeacherPicketController::class, 'action'])->name("teacher-picket.action");

        Route::resource("student", StudentController::class);
        Route::resource("teacher-picket", TeacherPicketController::class)->except(['delete', 'edit', 'update']);

        Route::resource("class-room", ClassRoomController::class)->except("show");
        Route::resource("lesson", LessonController::class)->except('show');
        Route::resource("time", TimeController::class)->except('show');
        Route::resource("lesson-timetable", LessonTimetableController::class);
        Route::resource("archive", ArchiveController::class)->only(['index', 'post', 'delete']);

        Route::prefix("profile/")->group(function () {
            Route::get("{id}/edit", [AccountController::class, "profile"])->name("profile");
            Route::put("{id}/update", [AccountController::class, "updateProfile"])->name("profile.update-image");
            Route::patch("{id}/update", [AccountController::class, "updateAccount"])->name("profile.update-account");
            Route::delete("{id}/delete", [AccountController::class, "deleteAccount"])->name("profile.delete");
        });
    });

    Route::prefix("teacher")->name("teacher.")->middleware("role:teacher")->group(function () {
        Route::get("dashboard", [DashboardController::class, "index"])->name("dashboard");

        Route::resource("student-achievement", StudentArchievementController::class);
        Route::resource("student-misconduct", StudentMisconductController::class);

        Route::resource("teacher-presence", TeacherPresenceController::class);
        Route::resource("archive", ArchiveController::class)->only(['index', 'post']);

        Route::prefix("profile/")->group(function () {
            Route::get("{id}/edit", [AccountController::class, "profile"])->name("profile");
            Route::put("{id}/update", [AccountController::class, "updateProfile"])->name("profile.update-image");
            Route::patch("{id}/update", [AccountController::class, "updateAccount"])->name("profile.update-account");
            Route::delete("{id}/delete", [AccountController::class, "deleteAccount"])->name("profile.delete");
        });
    });

    Route::post("/logout", [AuthController::class, 'logout'])->name("logout");
});
