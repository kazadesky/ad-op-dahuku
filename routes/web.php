<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Rute untuk Login Page dan Login Proses
Route::get("/", [AuthController::class, 'loginPage'])->name("login");
Route::post("/", [AuthController::class, "loginProses"])->name("login.proses");

Route::middleware("auth")->group(function () {
    Route::prefix("super-admin")->name("sa.")->middleware("role:super_admin")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'dashboardSA'])->name('dashboard');
    });

    Route::prefix("admin")->name("admin.")->middleware("role:admin")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'dashboardAdmin'])->name('dashboard');
        Route::resource("student", StudentController::class);
    });

    Route::prefix("operator")->name("operator.")->middleware("role:operator")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'dashboardOperator'])->name('dashboard');
    });

    Route::post("/logout", [AuthController::class, 'logout'])->name("logout");
});
