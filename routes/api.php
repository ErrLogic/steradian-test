<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/cars', [CarController::class, 'getCars']);
Route::get('/cars/{id}', [CarController::class, 'getCarById']);
Route::post('/cars', [CarController::class, 'createCar']);
Route::put('/cars/{id}', [CarController::class, 'updateCar']);
Route::delete('/cars/{id}', [CarController::class, 'deleteCar']);

Route::get('/orders', [OrderController::class, 'getOrders']);
Route::get('/orders/{id}', [OrderController::class, 'getOrderById']);
Route::post('/orders', [OrderController::class, 'createOrder']);
Route::put('/orders/{id}', [OrderController::class, 'updateOrder']);
Route::delete('/orders/{id}', [OrderController::class, 'deleteOrder']);
