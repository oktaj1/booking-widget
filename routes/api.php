<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Hotel\RoomController;
use App\Http\Controllers\Hotel\HotelController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Hotel\BookingController;
use App\Http\Controllers\Auth\VerificationController;




Route::prefix('api')->group(function () {
    Route::get('/hotels', [HotelController::class, 'index']); // List all hotels
    // TODO: here would be better if we had this endpoint call a method in the HotelController to a rooms() method
    // that would show all the rooms that hotel has
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



Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
