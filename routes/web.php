<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\WishlistController;
use App\Models\Address;

Route::get('/', [ProductController::class, 'index'])->name('product.index');
Route::post('/', [ProductController::class, 'store'])->name('product.store');
Route::get('/login', [userController::class, 'login'])->name('login');
Route::post('/login/process', [userController::class, 'processlogin'])->name('login.store');
Route::get('/regis', [userController::class, 'regis']);
Route::post('/regis/submit', [userController::class, 'store'])->name('user.store');


Route::middleware(['check'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/logout', [userController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('user.index');
    Route::get('/keranjang', [CartController::class, 'index'])->name('user.cart');
    Route::get('/keranjang/{id_produk}/{quantity}', [CartController::class, 'store'])->name('cart.store');
    Route::get('checkout', [CartController::class, 'index'])->name('checkout');
    Route::get('checkout/{idcart}/alamat/{alamatId}', [CartController::class, 'show'])->name('checkout.show');
    Route::get('rincianpembayaran', [CartController::class, 'paymentDetails'])->name('payment.details');    
    Route::get('/profile', [userController::class, 'profile'])->name('user.profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('/wishlist/{id_produk}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    Route::get('/product/{namaproduk}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/category/{category}', [ProductController::class, 'category'])->name('cate.show');
    Route::get('/allproduct',[ProductController::class,'all'])->name('product.all');
    Route::resource('product', ProductController::class)->except(['index', 'show']);
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/checkout', [OrderController::class, 'showCheckoutPage'])->name('checkout');
    Route::get('/rincianpembayaran', [OrderController::class, 'showPaymentDetails'])->name('rincianpembayaran');
    Route::get('/addaddress', [AddressController::class, 'create'])->name('addaddress');
    Route::post('/addaddress/submit', [AddressController::class, 'store'])->name('storeaddress');
    Route::get('/addresses/{id}/edit', [AddressController::class, 'edit'])->name('edit-address');
    Route::delete('/addresses/{id}', [AddressController::class, 'destroy'])->name('addresses.destroy');
    Route::put('/addresses/{id}', [AddressController::class, 'update'])->name('addresses.update');

});
Route::middleware(['checkAdmin'])->group(function () {
    Route::get('/mainAdmin',[ProductController::class,'admin'])->name('admin.main');
    Route::post('/logout', [userController::class, 'logout'])->name('logout');
    Route::get('/registerproduct', [ProductController::class, 'create'])->name('product.create');
    Route::post('/registerproduct', [ProductController::class, 'store'])->name('product.store');

    // Route::put('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'tampilanedit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}',[ProductController::class,'destroy'])->name('product.destroy');
    
    Route::get('/datapengiriman', [ShipmentController::class, 'index'])->name('datapengiriman');
    Route::put('/buktibayar/{id}/status', [ShipmentController::class, 'changeStatus'])->name('changestatus');

});
