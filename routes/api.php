<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerificationController;



Route::prefix('api')->group(function () {
    Route::get('/hotels', [HotelController::class, 'index']); // List all hotels
    Route::get('/hotels/{hotel}/rooms', [RoomController::class, 'index']); // List rooms for a hotel
    Route::post('/bookings', [BookingController::class, 'store']); // Book a room
    Route::get('/bookings', [BookingController::class, 'index']); // User's bookings
});


Route::middleware(['role:hotel_owner'])->group(function () {
    Route::post('/manage-hotel', [HotelController::class, 'manage']);
});

Route::middleware(['role:hotel_employee'])->group(function () {
    Route::get('/view-bookings', [BookingController::class, 'index']);
});



Route::get('/verify/{token}/{email}', [VerificationController::class, 'verify'])->name('verification.verify');



Route::post('/register', [RegisterController::class, 'register']);