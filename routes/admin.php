<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::group(['prefix' => 'admin', 'as' => 'admin.',  'middleware' => 'auth'], function () {
    Route::get('/member-list', [UserController::class, 'memberList'])->name('member-list');
    Route::get('/products-list-view', [ProductController::class, 'list'])->name('product-list');
    Route::get('/products-user-view', [ProductController::class, 'index'])->name('product-index');
    Route::get('/product-user-view/{product}', [ProductController::class, 'show'])->name('product-show');
    Route::get('/new-orders', [OrderController::class, 'new'])->name('new-order-list');
    Route::get('/order-history', [OrderController::class, 'history'])->name('order-history-list');

});
Route::group(['prefix' => 'admin/products', 'as' => 'admin.products.',  'middleware' => ['auth', 'role:superadmin|admin',]], function () {
    Route::get('/create', [ProductController::class, 'create'])->name('create');
});
