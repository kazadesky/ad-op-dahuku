<?php

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

// Rute untuk Login Page dan Login Proses
Route::get("/", [AuthController::class, 'loginPage'])->name("login");
Route::post("/", [AuthController::class, "loginProses"])->name("login.proses");
Route::get("/register", [AuthController::class, "registerPage"])->name("register");
Route::post("/register", [AuthController::class, "registerProses"])->name("register.proses");

Route::middleware("auth")->group(function () {
    Route::prefix("super-admin")->name("sa.")->middleware("role:super_admin")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::prefix("admin")->name("admin.")->middleware("role:admin")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');
        Route::patch("teacher-picket/{id}/action", [TeacherPicketController::class, 'action'])->name("teacher-picket.action");

        Route::resource("student", StudentController::class);
        Route::resource("student-guardian", StudentGuardianController::class);
        Route::resource("monthly-payment", MonthlyPaymentController::class);
        Route::resource("student-achievement", StudentArchievementController::class)->except('show');
        Route::resource("student-misconduct", StudentMisconductController::class)->except('show');

        Route::resource("teacher", TeacherController::class)->only(['index', 'edit', 'update']);
        Route::resource("teacher-picket", TeacherPicketController::class);
        Route::resource("teacher-presence", TeacherPresenceController::class);

        Route::resource("class-room", ClassRoomController::class)->except("show");
        Route::resource("lesson", LessonController::class);
        Route::resource("time", TimeController::class)->except('show');
        Route::resource("lesson-timetable", LessonTimetableController::class);
        Route::resource("archive", ArchiveController::class)->only(['index', 'post']);
    });

    Route::prefix("operator")->name("operator.")->middleware("role:operator")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::prefix("teacher")->name("teacher.")->middleware("role:teacher")->group(function () {
        Route::get("dashboard", [DashboardController::class, "index"])->name("dashboard");

        Route::resource("student-achievement", StudentArchievementController::class)->except('show');
        Route::resource("student-misconduct", StudentMisconductController::class)->except('show');

        Route::resource("teacher-presence", TeacherPresenceController::class);
        Route::resource("archive", ArchiveController::class)->only(['index', 'post']);
    });

    Route::post("/logout", [AuthController::class, 'logout'])->name("logout");
});
