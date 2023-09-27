<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;

Route::group(['prefix' => 'member/', 'as' => 'member.',  'middleware' => ['auth', 'role:superadmin|admin|user',]], function () {
    Route::get('announcement', [UserController::class, 'announcement'])->name('announcement');
    Route::get('cart', [UserController::class, 'cart'])->name('cart');
    Route::get('cart/checkout', [UserController::class, 'checkout'])->name('checkout');
    Route::get('commission', [UserController::class, 'commission'])->name('commission');
    Route::get('bonus', [UserController::class, 'bonus'])->name('bonus');
    Route::get('internal-transfer/history', [UserController::class, 'internalTransferHistory'])->name('internal-transfer-history');
    Route::get('internal-transfer/new', [UserController::class, 'internalTransferNew'])->name('new-internal-transfer');
    Route::get('member-listing', [UserController::class, 'memberListing'])->name('listing');
    Route::get('member-network-tree', [UserController::class, 'memberNetworkTree'])->name('network-tree');
    Route::get('orders/history', [UserController::class, 'pendingOrder'])->name('order-pending');
    Route::post('pending-orders/{order}', [UserController::class, 'cancelorder'])->name('cancelorder');



    // Route::get('purchase-wallet', [UserController::class, 'purchaseWallet'])->name('purchase-wallet');
    // Route::get('pending-topup', [UserController::class, 'pendingTopup'])->name('pending-topup');
    // Route::get('topup-history', [UserController::class, 'topupHistory'])->name('topup-history');

    Route::get('cash-wallet', [UserController::class, 'cashWallet'])->name('cash-wallet');
    Route::get('product-wallet', [UserController::class, 'productWallet'])->name('product-wallet');




    Route::get('sales-report', [ReportController::class, 'reportSales'])->name('report-sales');
    Route::get('downline-sales-report', [ReportController::class, 'reportDownlineSales'])->name('report-downline-sales');
    Route::get('wallets-report', [ReportController::class, 'reportWallet'])->name('report-wallet');
    Route::get('monthly-commission-report', [ReportController::class, 'monthlyCommissionReport'])->name('monthly-commission-report');
    Route::get('quarterly-commission-report', [ReportController::class, 'quarterlyCommissionReport'])->name('quarterly-commission-report');
    Route::get('annually-commission-report', [ReportController::class, 'annuallyCommissionReport'])->name('annually-commission-report');
    Route::get('performance-bonus-report', [ReportController::class, 'performanceBonusReport'])->name('performance-bonus-report');
    Route::get('retail-profit-report', [ReportController::class, 'retailprofit'])->name('retailprofit');
    
    // Route::get('report-leadership', [ReportController::class, 'reportLeadership'])->name('report-leadership');
    // Route::get('report-levelling', [ReportController::class, 'reportLevelling'])->name('report-levelling');
});
Route::post('/updateQty/{itemId}/{action}', [CartController::class, 'updateQty'])->name('updateQty');

Route::delete('/cart/{cart}/item/{productId}', [CartController::class, 'destroy'])->name('cart.item.destroy');

// AJAX
Route::group(['prefix' => 'member/',  'middleware' => 'auth', 'middleware' => 'role:user'], function () {
    Route::get('/cart/records', [UserController::class, 'getCartRecords'])->name('cart.fetch');
    // Route::middleware('check.cart.item')->group(function () {
    Route::get('/cart/get', [CartController::class, 'getCartData'])->name('cart.get');
    // });
    Route::post('/get-shipping-charge', [CartController::class, 'getShippingCharge'])->name('get-shipping-charge');
    Route::get('get-cart-count', [CartController::class, 'getCartCount'])->name('cart.count');
    Route::post('/products/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('ajax.cart.update');
    Route::post('/ajax-place-order', [OrderController::class, 'placeOrder'])->name('place-order');
});
