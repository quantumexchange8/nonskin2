<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::group(['prefix' => 'admin', 'as' => 'admin.',  'middleware' => 'auth'], function () {
    Route::get('/member-list', [UserController::class, 'memberList'])->name('member-list');
    Route::get('/list', [ProductController::class, 'list'])->name('product-list');
    Route::get('/new-orders', [OrderController::class, 'new'])->name('new-order-list');
    Route::get('/order-list/grid-data', [OrderController::class, 'gridData'])->name('new-order-gridData');
    Route::get('/order-history', [OrderController::class, 'history'])->name('order-history-list');

});
