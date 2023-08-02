<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::group(['prefix' => 'admin', 'as' => 'admin.',  'middleware' => 'auth'], function () {
    Route::get('/member-list', [UserController::class, 'memberList'])->name('member-list');

    Route::get('/new-orders', [OrderController::class, 'new'])->name('new-order-list');
    Route::get('/order-history', [OrderController::class, 'history'])->name('order-history-list');

});
Route::group(['prefix' => 'admin/products', 'as' => 'admin.products.',  'middleware' => ['auth', 'role:superadmin|admin',]], function () {
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
    Route::get('/list-view', [ProductController::class, 'list'])->name('list');
    Route::get('/user-view', [ProductController::class, 'index'])->name('index');
    Route::get('/user-view/{product}', [ProductController::class, 'show'])->name('show');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::post('/update/{product}', [ProductController::class, 'update'])->name('update');
    Route::post('/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');
});

// Settings
Route::group(['prefix' => 'admin/settings', 'as' => 'admin.settings.',  'middleware' => ['auth', 'role:superadmin|admin',]], function () {
    Route::get('/product-categories', [UserController::class, 'categorySettings'])->name('categories');
    Route::get('/shipping-charges', [UserController::class, 'shippingCharges'])->name('shipping-charges');
    Route::get('/banks', [UserController::class, 'bankSettings'])->name('banks');
    Route::get('/company-info', [UserController::class, 'companyInfo'])->name('company-info');
    Route::post('/product-category/update', [UserController::class, 'categoryStore'])->name('category-store');
    Route::post('/shipping-charge/update', [UserController::class, 'chargeStore'])->name('charge-store');
    Route::post('/bank/update', [UserController::class, 'bankStore'])->name('bank-store');
    Route::delete('/product-category/destroy/{category}', [UserController::class, 'categoryDestroy'])->name('category-destroy');
    Route::delete('/shipping-charge/destroy/{charge}', [UserController::class, 'chargeDestroy'])->name('charge-destroy');
    Route::delete('/bank/destroy/{bank}', [UserController::class, 'bankDestroy'])->name('bank-destroy');
});
