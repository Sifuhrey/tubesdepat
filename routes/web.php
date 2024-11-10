<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class, 'index'])->name('product.index');
Route::post('/', [ProductController::class, 'store'])->name('product.store');

Route::get('/login', [userController::class, 'index'])->name('product.store');


