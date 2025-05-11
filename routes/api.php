<?php

use App\Http\Controllers\APi\RegisterController;
use App\Http\Controllers\APi\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(RegisterController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {
    Route::controller(VehicleController::class)->group(function () {
        Route::get('/vehicles', 'index');
        Route::post('/vehicle', 'store');
        Route::get('/vehicle/{id}', 'show');
        Route::put('/vehicle/{id}', 'update');
        Route::delete('/vehicle/{id}', 'destroy');
    });
});