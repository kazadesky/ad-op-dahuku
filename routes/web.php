<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get("", [AuthController::class, 'loginPage'])->name("login");
Route::post("", [AuthController::class, "loginProses"])->name("login.proses");

Route::middleware("auth")->group(function () {
    Route::prefix("super-admin")->name("sa.")->middleware("role:super_admin")->group(function () {});

    Route::prefix("admin")->name("admin.")->middleware("role:admin")->group(function () {
        Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::prefix("operator")->name("operator.")->middleware("role:operator")->group(function () {});

    Route::post("logout", [AuthController::class, 'logout'])->name("logout");
});
