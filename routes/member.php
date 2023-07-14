<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Member\UserController;

Route::group(['prefix' => 'member/',  'middleware' => 'auth', 'middleware' => 'role:user'], function () {
    Route::get('announcement', [UserController::class, 'announcement']);
    Route::get('commission', [UserController::class, 'commission']);
    Route::get('internal-transfer-history', [UserController::class, 'internalTransferHistory']);
    Route::get('internal-transfer-new', [UserController::class, 'internalTransferNew']);
    Route::get('member-network', [UserController::class, 'memberNetwork']);
    Route::get('member-tree', [UserController::class, 'memberTree']);
    Route::get('order-history', [UserController::class, 'orderHistory']);
    Route::get('order-pending', [UserController::class, 'orderPending']);
    Route::get('products', [UserController::class, 'productList']);
    Route::get('products/{product}', [UserController::class, 'productDetail']);
    Route::get('report-downline-sales', [UserController::class, 'reportDownlineSales']);
    Route::get('report-leadership', [UserController::class, 'reportLeadership']);
    Route::get('report-levelling', [UserController::class, 'reportLevelling']);
    Route::get('report-sales', [UserController::class, 'reportSales']);
    Route::get('report-wallet', [UserController::class, 'reportWallet']);
    Route::get('topup-history', [UserController::class, 'topupHistory']);
    Route::get('topup-pending', [UserController::class, 'topupPending']);
    Route::get('withdrawal-history', [UserController::class, 'withdrawalHistory']);
    Route::get('withdrawal-pending', [UserController::class, 'withdrawalPending']);
});

// AJAX
Route::group(['prefix' => 'member/',  'middleware' => 'auth', 'middleware' => 'role:user'], function () {
    Route::post('/cart/add', [UserController::class, 'addToCart'])->name('cart.add');
});
