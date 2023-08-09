<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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
