<?php
// routes/web.php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PlaylistController as AdminPlaylistController;
use App\Http\Controllers\Admin\AccessCodeController as AdminAccessCodeController;
use App\Http\Controllers\Admin\VRVideoController as AdminVRVideoController;

// Public routes
Route::get('/', function () {
    return view('home');
})->name('home');





// Authentication routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


// Profile routes
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Admin routes with prefix and name
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    // User management
    Route::resource('users', AdminUserController::class);

    // Playlist management
    Route::resource('playlists', AdminPlaylistController::class);

    // Access code management
    Route::resource('codes', AdminAccessCodeController::class);

    Route::resource('videos', AdminVRVideoController::class);
});

