<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\OrderController;



Route::get('/', [ProductController::class, 'index'])->name('product.index');
Route::post('/', [ProductController::class, 'store'])->name('product.store');
Route::get('/login', [userController::class, 'login'])->name('login');
Route::get('/regis', [userController::class, 'regis']);
Route::post('/regis', [userController::class, 'store'])->name('user.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});
