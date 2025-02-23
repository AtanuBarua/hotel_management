<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\AuthController as AdminAuthController;

Route::get('/', [HomeController::class, 'index'])->name('/');

Route::prefix('admin')->group(function() {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'loginProcess'])->name('admin.login');
    Route::middleware('auth')->group(function() {
        Route::get('/', [AdminHomeController::class, 'index'])->name('admin.dashboard');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});
