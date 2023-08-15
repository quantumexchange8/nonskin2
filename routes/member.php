<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::group(['prefix' => 'member/', 'as' => 'member.',  'middleware' => ['auth', 'role:superadmin|admin|user',]], function () {
    Route::get('announcement', [UserController::class, 'announcement'])->name('announcement');
    Route::get('cart', [UserController::class, 'cart'])->name('cart');
    Route::get('cart/checkout', [UserController::class, 'checkout'])->name('checkout');
    Route::get('commission', [UserController::class, 'commission'])->name('commission');
    // Route::get('wallet/deposit', [UserController::class, 'deposit'])->name('wallet-deposit');
    // Route::get('wallet/withdrawal', [UserController::class, 'withdrawal'])->name('wallet-withdrawal');
    Route::get('bonus', [UserController::class, 'bonus'])->name('bonus');
    Route::get('internal-transfer/history', [UserController::class, 'internalTransferHistory'])->name('internal-transfer-history');
    Route::get('internal-transfer/new', [UserController::class, 'internalTransferNew'])->name('new-internal-transfer');
    Route::get('member-listing', [UserController::class, 'memberListing'])->name('listing');
    Route::get('member-listing/{user}/detail', [UserController::class, 'memberDetail'])->name('member-detail');
    Route::get('member-network-tree', [UserController::class, 'memberNetworkTree'])->name('network-tree');
    Route::get('order-history', [UserController::class, 'orderHistory'])->name('order-pending');
    Route::post('pending-orders/{order}', [UserController::class, 'cancelorder'])->name('cancelorder');

    // Route::get('order-history', [UserController::class, 'orderHistory'])->name('order-history');
    // Route::get('products', [ProductController::class, 'index'])->name('product-list');
    Route::get('deposit', [UserController::class, 'purchaseWalletDeposit'])->name('deposit');
    Route::get('withdraw', [UserController::class, 'purchaseWalletWithdraw'])->name('withdraw');

    Route::get('purchase-wallet', [UserController::class, 'purchaseWallet'])->name('purchase-wallet');
    Route::get('cash-wallet', [UserController::class, 'cashWallet'])->name('cash-wallet');
    Route::get('product-wallet', [UserController::class, 'productWallet'])->name('product-wallet');


    Route::get('report-downline-sales', [UserController::class, 'reportDownlineSales'])->name('report-downline-sales');
    Route::get('report-leadership', [UserController::class, 'reportLeadership'])->name('report-leadership');
    Route::get('report-levelling', [UserController::class, 'reportLevelling'])->name('report-levelling');
    Route::get('report-sales', [UserController::class, 'reportSales'])->name('report-sales');
    Route::get('report-wallet', [UserController::class, 'reportWallet'])->name('report-wallet');
    // Route::get('topup-history', [UserController::class, 'topupHistory'])->name('topup-history');
    // Route::get('topup-pending', [UserController::class, 'topupPending'])->name('topup-pending');
    // Route::get('withdrawal-history', [UserController::class, 'withdrawalHistory'])->name('withdrawal-history');
    // Route::get('withdrawal-pending', [UserController::class, 'withdrawalPending'])->name('withdrawal-pending');
});
Route::post('/updateQty/{itemId}/{action}', [CartController::class, 'updateQty'])->name('updateQty');

Route::delete('/cart/{cart}/item/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');

// AJAX
Route::group(['prefix' => 'member/',  'middleware' => 'auth', 'middleware' => 'role:user'], function () {
    Route::get('/cart/records', [UserController::class, 'getCartRecords'])->name('cart.fetch');
    // Route::middleware('check.cart.item')->group(function () {
    Route::get('/cart/get', [CartController::class, 'getCartData'])->name('cart.get');
    // });
    Route::post('/get-shipping-charge', [CartController::class, 'getShippingCharge'])->name('get-shipping-charge');
    Route::get('get-cart-count', [CartController::class, 'getCartCount'])->name('cart.count');
    Route::post('/products/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/ajax-place-order', [OrderController::class, 'placeOrder'])->name('place-order');
});
