<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::group(['prefix' => 'admin', 'as' => 'admin.',  'middleware' => 'auth'], function () {
    Route::get('/members_listing', [AdminController::class, 'memberList'])->name('member-list');

    
    Route::get('/orders/history', [OrderController::class, 'history'])->name('order-history-list');

    // Route::get('/wallets/pending-deposit', [AdminController::class, 'pendingDeposit'])->name('wallet-pending-deposit');
    // Route::get('/wallets/pending-withdrawal', [AdminController::class, 'pendingWithdrawal'])->name('wallet-pending-withdrawal');

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
    Route::get('/product-categories', [AdminController::class, 'categorySettings'])->name('categories');
    Route::post('/product-category/update', [AdminController::class, 'categoryStore'])->name('category-store');
    Route::delete('/product-category/destroy/{category}', [AdminController::class, 'categoryDestroy'])->name('category-destroy');
    Route::get('/shipping-charges', [AdminController::class, 'shippingCharges'])->name('shipping-charges');
    Route::post('/shipping-charge/update', [AdminController::class, 'chargeStore'])->name('charge-store');
    Route::delete('/shipping-charge/destroy/{charge}', [AdminController::class, 'chargeDestroy'])->name('charge-destroy');
    Route::get('/banks', [AdminController::class, 'bankSettings'])->name('banks');
    Route::post('/bank/update', [AdminController::class, 'bankStore'])->name('bank-store');
    Route::delete('/bank/destroy/{bank}', [AdminController::class, 'bankDestroy'])->name('bank-destroy');
    Route::get('/company-info', [AdminController::class, 'companyInfo'])->name('company-info');
});
