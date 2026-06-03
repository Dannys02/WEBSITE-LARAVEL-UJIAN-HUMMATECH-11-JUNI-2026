<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Routes untuk autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/portal/daftar/admin', [UserController::class, 'showRegister'])->name('register');
    Route::post('/portal/daftar/admin', [UserController::class, 'register']);
    Route::get('/portal/login/admin', [UserController::class, 'showLogin'])->name('login');
    Route::post('/portal/login/admin', [UserController::class, 'login']);
});

// Route untuk dashboard admin (hanya bisa diakses setelah login)
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Products Routes
        Route::resource('products', ProductController::class);

        // Settings Routes
        Route::get('/settings', [SettingsController::class, 'showSettings'])->name('settings.show');
        Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.update-profile');
        Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.update-password');

        // logout
        Route::post('/portal/logout/admin', [UserController::class, 'logout'])->name('logout');
    });
});
