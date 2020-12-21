<?php

use App\Http\Controllers\DishesController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [OrderController::class, 'index'])->name('order.form');
Route::post('/', [OrderController::class, 'search']);
Route::post('/order_submit', [OrderController::class, 'submit'])->name('order.submit');
Route::get('/orders/{order}/serve', [OrderController::class, 'serve']);

Route::resource('/dish', DishesController::class);
Route::get('/orders', [DishesController::class, 'order'])->name('kitechen.order');
Route::get('/orders/{order}/approve', [DishesController::class, 'approve']);
Route::get('/orders/{order}/cancle', [DishesController::class, 'cancle']);
Route::get('/orders/{order}/ready', [DishesController::class, 'ready']);


Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false
]);