<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Member\UserController;

Route::group(['prefix' => 'member/', 'as' => 'member.',  'middleware' => 'auth', 'middleware' => 'role:user'], function () {
    Route::get('announcement', [UserController::class, 'announcement'])->name('announcement');
    Route::get('commission', [UserController::class, 'commission'])->name('commission');
    Route::get('internal-transfer-history', [UserController::class, 'internalTransferHistory'])->name('internal-transfer-history');
    Route::get('internal-transfer-new', [UserController::class, 'internalTransferNew'])->name('internal-transfer-new');
    Route::get('member-network', [UserController::class, 'memberNetwork'])->name('member-network');
    Route::get('member-tree', [UserController::class, 'memberTree'])->name('member-tree');
    Route::get('order-history', [UserController::class, 'orderHistory'])->name('order-history');
    Route::get('order-pending', [UserController::class, 'orderPending'])->name('order-pending');
    Route::get('products', [UserController::class, 'productList'])->name('product-list');
    Route::get('products/{product}', [UserController::class, 'productDetail'])->name('product-detail');
    Route::get('report-downline-sales', [UserController::class, 'reportDownlineSales'])->name('report-downline-sales');
    Route::get('report-leadership', [UserController::class, 'reportLeadership'])->name('report-leadership');
    Route::get('report-levelling', [UserController::class, 'reportLevelling'])->name('report-levelling');
    Route::get('report-sales', [UserController::class, 'reportSales'])->name('report-sales');
    Route::get('report-wallet', [UserController::class, 'reportWallet'])->name('report-wallet');
    Route::get('topup-history', [UserController::class, 'topupHistory'])->name('topup-history');
    Route::get('topup-pending', [UserController::class, 'topupPending'])->name('topup-pending');
    Route::get('withdrawal-history', [UserController::class, 'withdrawalHistory'])->name('withdrawal-history');
    Route::get('withdrawal-pending', [UserController::class, 'withdrawalPending'])->name('withdrawal-pending');
});

// AJAX
Route::group(['prefix' => 'member/',  'middleware' => 'auth', 'middleware' => 'role:user'], function () {
    Route::post('/products/cart/add', [UserController::class, 'addToCart'])->name('cart.add');
});
