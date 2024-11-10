<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', [ProductController::class, 'index'])->name('product.index');
Route::post('/', [ProductController::class, 'store'])->name('product.store');
Route::get('/login', [UserController::class, 'index'])->name('product.store');
Route::get('/regis', [UserController::class, 'regis']);
Route::post('/regis', [UserController::class, 'store'])->name('store');

