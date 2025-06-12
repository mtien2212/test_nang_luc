<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Đăng ký
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'register']);

// Đăng nhập
Route::get('/', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);

// Đăng xuất
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Dashboard (bảo vệ bằng middleware auth)
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware('auth')->name('dashboard');
