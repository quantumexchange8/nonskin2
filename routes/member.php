<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::group(['prefix' => 'member/', 'as' => 'member.',  'middleware' => ['auth', 'role:superadmin|user',]], function () {
    Route::get('announcement', [UserController::class, 'announcement'])->name('announcement');
    Route::get('cart', [UserController::class, 'cart'])->name('cart');
    Route::get('cart/checkout', [UserController::class, 'checkout'])->name('checkout');
    Route::get('commission', [UserController::class, 'commission'])->name('commission');
    Route::get('internal-transfer-history', [UserController::class, 'internalTransferHistory'])->name('internal-transfer-history');
    Route::get('internal-transfer-new', [UserController::class, 'internalTransferNew'])->name('internal-transfer-new');
    Route::get('member-network', [UserController::class, 'memberNetwork'])->name('member-network');
    Route::get('member-tree', [UserController::class, 'memberTree'])->name('member-tree');
    Route::get('order-history', [UserController::class, 'orderHistory'])->name('order-history');
    Route::get('order-pending', [UserController::class, 'orderPending'])->name('order-pending');
    Route::get('products', [ProductController::class, 'index'])->name('product-list');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('product-detail');
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
Route::post('/updateQty/{itemId}/{action}', [CartController::class, 'updateQty'])->name('updateQty');

Route::delete('/cart/{cart}/item/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');

// AJAX
Route::group(['prefix' => 'member/',  'middleware' => 'auth', 'middleware' => 'role:user'], function () {
    Route::get('/cart/records', [UserController::class, 'getCartRecords'])->name('cart.fetch');
    Route::middleware('check.cart.item')->group(function () {
        Route::get('cart/get', [CartController::class, 'getCartData'])->name('cart.get');
    });
    Route::get('get-cart-count', [CartController::class, 'getCartCount'])->name('cart.count');
    Route::post('/products/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/ajax-place-order', [OrderController::class, 'placeOrder'])->name('place-order');
});
