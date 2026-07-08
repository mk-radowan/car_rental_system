<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CarController::class, 'home'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/car/{id}', [CarController::class, 'show'])->name('cars.show');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [BookingController::class, 'dashboard'])->name('dashboard');
    Route::post('/book/{id}', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/history', [BookingController::class, 'history'])->name('bookings.history');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/car/{id}/review', [ProfileController::class, 'storeReview'])->name('reviews.store');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/cars', [AdminController::class, 'cars'])->name('admin.cars');
    Route::get('/cars/create', [AdminController::class, 'createCar'])->name('admin.cars.create');
    Route::post('/cars', [AdminController::class, 'storeCar'])->name('admin.cars.store');
    Route::get('/cars/{id}/edit', [AdminController::class, 'editCar'])->name('admin.cars.edit');
    Route::put('/cars/{id}', [AdminController::class, 'updateCar'])->name('admin.cars.update');
    Route::delete('/cars/{id}', [AdminController::class, 'destroyCar'])->name('admin.cars.destroy');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::get('/bookings/{id}', [AdminController::class, 'viewBooking'])->name('admin.bookings.view');
    Route::post('/bookings/approve/{id}', [AdminController::class, 'approveBooking'])->name('admin.bookings.approve');
    Route::post('/bookings/reject/{id}', [AdminController::class, 'rejectBooking'])->name('admin.bookings.reject');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
});
