<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

    Route::get('/events', [EventController::class, 'show'])->name('getAllEvents');
    Route::get('/events/{id}/hall', [BlockController::class, 'show'])->name('getEventById');
    Route::post('/order', [OrderController::class, 'create'])->name('createOrder');
    Route::get('/order/{order}/confirm', [OrderController::class, 'confirm'])->name('confirmOrderById');
    Route::post('/order/{order}/cancel', [OrderController::class, 'cancel'])->name('cancelOrderById');
    Route::get('/order/{order}', [OrderController::class, 'get'])->name('getOrderById');

