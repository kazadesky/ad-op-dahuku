<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonthlyPaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentGuardianController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherPicketController;
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
        Route::get("teacher", [TeacherController::class, 'index'])->name("teacher.index");

        Route::resources([
            "student" => StudentController::class,
            "monthly-payment" => MonthlyPaymentController::class,
            "teacher-picket" => TeacherPicketController::class,
            "student-guardian" => StudentGuardianController::class,
            "class-room" => ClassRoomController::class,
        ]);

        Route::resource("archive", ArchiveController::class)->only(['index', 'post']);
    });

    Route::prefix("operator")->name("operator.")->middleware("role:operator")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::prefix("teacher")->name("teacher.")->middleware("role:teacher")->group(function () {
        Route::get("dashboard", [DashboardController::class, "index"])->name("dashboard");
    });

    Route::post("/logout", [AuthController::class, 'logout'])->name("logout");
});
