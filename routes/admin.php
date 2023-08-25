<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\member\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HomeController;

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
    Route::post('/company-info/update', [AdminController::class, 'companyInfoStore'])->name('company-info-store');
});

// Reports
Route::group(['prefix' => 'admin/', 'as' => 'admin.',  'middleware' => ['auth', 'role:superadmin|admin',]], function () {
    // Route::get('report-downline-sales', [ReportController::class, 'reportDownlineSales'])->name('report-downline-sales');
    // Route::get('report-leadership', [ReportController::class, 'reportLeadership'])->name('report-leadership');
    // Route::get('report-levelling', [ReportController::class, 'reportLevelling'])->name('report-levelling');
    Route::get('sales-report', [ReportController::class, 'reportSales'])->name('report-sales');
    Route::get('wallet-report', [ReportController::class, 'reportWallet'])->name('report-wallet');
    Route::get('monthly-commission-report', [ReportController::class, 'monthlyCommissionReport'])->name('monthly-commission-report');
    Route::get('quarterly-commission-report', [ReportController::class, 'quarterlyCommissionReport'])->name('quarterly-commission-report');
    Route::get('annually-commission-report', [ReportController::class, 'annuallyCommissionReport'])->name('annually-commission-report');
    Route::get('performance-bonus-report', [ReportController::class, 'performanceBonusReport'])->name('performance-bonus-report');
});

