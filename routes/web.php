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
    Route::get('/portal/daftar/user', [UserController::class, 'showRegister'])->name('register');
    Route::post('/portal/daftar/user', [UserController::class, 'register']);
    Route::get('/portal/login/user', [UserController::class, 'showLogin'])->name('login');
    Route::post('/portal/login/user', [UserController::class, 'login']);
});

// Route untuk dashboard admin (hanya bisa diakses setelah login)
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Products Routes
    Route::resource('products', ProductController::class);

    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'showSettings'])->name('settings.show');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.update-profile');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.update-password');

    // logout
    Route::post('/portal/logout/user', [UserController::class, 'logout'])->name('logout');
});

