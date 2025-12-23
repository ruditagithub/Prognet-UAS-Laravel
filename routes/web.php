<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes - User must be logged in
Route::middleware(['check.auth'])->group(function () {
    Route::get('/book', [BookingController::class, 'showBookingForm'])->name('bookings.create');
    Route::post('/book', [BookingController::class, 'store'])->name('bookings.store');
});

// Admin Routes
Route::middleware(['check.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // User Management
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/delete', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Room Management
    Route::post('/rooms', [AdminRoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{id}/edit', [AdminRoomController::class, 'edit'])->name('rooms.edit');
    Route::post('/rooms/{id}', [AdminRoomController::class, 'update'])->name('rooms.update');
    Route::get('/rooms/{id}/delete', [AdminRoomController::class, 'destroy'])->name('rooms.destroy');

    // Booking Management
    Route::get('/bookings/{booking_id}/edit', [AdminBookingController::class, 'edit'])->name('bookings.edit');
    Route::post('/bookings/{booking_id}', [AdminBookingController::class, 'update'])->name('bookings.update');
    Route::get('/bookings/{booking_id}/delete', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');
});
