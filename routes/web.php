<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController; // เพิ่ม LoginController ถ้าขาด

// ----------------------
// USER LOGIN
// ----------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ----------------------
// Public Home Page
// ----------------------
Route::get('/', function () {
    return view('auth.login');
});

// ----------------------
// User Auth Routes
// ----------------------
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ----------------------
// User Profile Routes
// ----------------------
Route::resource('user-profiles', UserProfileController::class);
Route::get('/user-profiles/{id}/edit', [UserProfileController::class, 'edit'])->name('user-profiles.edit');
Route::put('/user-profiles/{id}', [UserProfileController::class, 'update'])->name('user-profiles.update');
Route::post('/user-profiles/{id}/confirm', [UserProfileController::class, 'confirm'])->name('user-profiles.confirm');

// ----------------------
// Calendar Routes
// ----------------------
Route::get('/calendar-events/{id}/edit', [CalendarEventController::class, 'edit'])->name('calendar-events.edit');

// ----------------------
// Laravel Breeze Auth
// ----------------------
require __DIR__ . '/auth.php';