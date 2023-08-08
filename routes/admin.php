<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::group(['prefix' => 'admin', 'as' => 'admin.',  'middleware' => 'auth'], function () {
    Route::get('/members/listing', [UserController::class, 'memberList'])->name('member-list');

    Route::get('/orders/listing', [OrderController::class, 'new'])->name('new-order-list');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('order-history-list');

    // Route::get('/wallets/pending-deposit', [UserController::class, 'pendingDeposit'])->name('wallet-pending-deposit');
    // Route::get('/wallets/pending-withdrawal', [UserController::class, 'pendingWithdrawal'])->name('wallet-pending-withdrawal');

});
Route::group(['prefix' => 'admin/products', 'as' => 'admin.products.',  'middleware' => ['auth', 'role:superadmin|admin',]], function () {
    // Route::get('/user-view', [ProductController::class, 'index'])->name('index');
    Route::get('/', [ProductController::class, 'listing'])->name('list');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::post('/update/{product}', [ProductController::class, 'update'])->name('update');
    Route::post('/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');
});

// Settings
Route::group(['prefix' => 'admin/settings', 'as' => 'admin.settings.',  'middleware' => ['auth', 'role:superadmin|admin',]], function () {
    Route::get('/product-categories', [UserController::class, 'categorySettings'])->name('categories');
    Route::post('/product-category/update', [UserController::class, 'categoryStore'])->name('category-store');
    Route::delete('/product-category/destroy/{category}', [UserController::class, 'categoryDestroy'])->name('category-destroy');
    Route::get('/shipping-charges', [UserController::class, 'shippingCharges'])->name('shipping-charges');
    Route::post('/shipping-charge/update', [UserController::class, 'chargeStore'])->name('charge-store');
    Route::delete('/shipping-charge/destroy/{charge}', [UserController::class, 'chargeDestroy'])->name('charge-destroy');
    Route::get('/banks', [UserController::class, 'bankSettings'])->name('banks');
    Route::post('/bank/update', [UserController::class, 'bankStore'])->name('bank-store');
    Route::delete('/bank/destroy/{bank}', [UserController::class, 'bankDestroy'])->name('bank-destroy');
    Route::get('/company-info', [UserController::class, 'companyInfo'])->name('company-info');
});
