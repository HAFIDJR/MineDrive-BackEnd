<?php

use App\Http\Controllers\APi\BookingController;
use App\Http\Controllers\APi\RegisterController;
use App\Http\Controllers\APi\VehicleController;
use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(RegisterController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::middleware(['auth:sanctum'])->group(function () {
    // Only for admins
    Route::middleware(['isAdmin'])->group(function () {
        Route::controller(VehicleController::class)->group(function () {
            Route::get('/vehicles', 'index');
            Route::post('/vehicle', 'store');
            Route::get('/vehicle/{id}', 'show');
            Route::put('/vehicle/{id}', 'update');
            Route::delete('/vehicle/{id}', 'destroy');
        });

        Route::controller(BookingController::class)->group(function () {
            Route::post('/booking', 'storeBooking');
            Route::delete('/booking/{id}', 'deleteBooking');
        });
    });
    Route::middleware(['isAdminOrApprover'])->group(function () {
        // Bookings accessible to all authenticated users (admin and non-admin)
        Route::controller(BookingController::class)->group(function () {
            Route::get('/bookings', 'getBookings');
            Route::get('/booking/{id}', 'showBooking');
            Route::put('/booking/{id}', 'updateBooking');
        });
    });
});