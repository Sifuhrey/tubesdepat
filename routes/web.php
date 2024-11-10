<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class, 'index'])->name('product.index');
Route::post('/', [ProductController::class, 'store'])->name('product.store');
Route::get('/regis', [UserController::class, 'regis']);
Route::post('/regis', [UserController::class, 'store'])->name('store');


