<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Routes untuk autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/daftar', [UserController::class, 'showRegister'])->name('register');
    Route::post('/daftar', [UserController::class, 'register']);
    Route::get('/login', [UserController::class, 'showLogin'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
});

// Route untuk dashboard admin (hanya bisa diakses setelah login)
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
