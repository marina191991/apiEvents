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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/events', [EventController::class, 'show'])->name('getAllEvents');
Route::get('/events/{id}/hall', [BlockController::class, 'show'])->name('getEventById');
Route::post('/order', [OrderController::class, 'create'])->name('createOrder');
Route::post('/order/{id}/confirm', [OrderController::class, 'confirm'])->name('getOrderById');
Route::post('/order/{id}/cancel', [OrderController::class, 'cancel'])->name('cancelOrderById');
Route::post('/order/{id}', [OrderController::class, 'get'])->name('getOrderById');

