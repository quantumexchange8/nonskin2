<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Member\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', function () {
    return view('auth/login');
});


Auth::routes();
// Route::get('/login', [LoginController::class, 'login'])->name('login');
// Route::post('/customlogin', [LoginController::class, 'customlogin'])->name('customlogin');

Route::resource('cart', CartController::class);
// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/register/{referral?}', [RegisterController::class, 'register'])->name('register');
Route::post('/add-member', [RegisterController::class, 'store'])->name('add.member');
Route::post('/check-existing-referral', [RegisterController::class, 'checkExistingReferral'])->name('registerExistingReferral');
Route::post('/check-unique-id', [RegisterController::class, 'checkUniqueID'])->name('registerUniqueID');
Route::post('/check-unique-username', [RegisterController::class, 'checkUniqueUsername'])->name('registerUniqueUsername');
Route::post('/check-unique-email', [RegisterController::class, 'checkUniqueEmail'])->name('registerUniqueEmail');
Route::post('/check-unique-contact', [RegisterController::class, 'checkUniqueContact'])->name('registerUniqueContact');


//Update User Profile
Route::get('/my-profile',[App\Http\Controllers\HomeController::class, 'myProfile'])->name('myProfile');
Route::post('/update-profile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-address', [App\Http\Controllers\HomeController::class, 'updateAddress'])->name('updateAddress');
Route::post('/toggle-default-address', [App\Http\Controllers\HomeController::class, 'toggleDefaultAddress'])->name('toggleDefaultAddress');
Route::post('/update-bank', [App\Http\Controllers\HomeController::class, 'updateBank'])->name('updateBank');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

/**
 * MEMBERS
 */
Route::group(['prefix' => 'members',  'middleware' => ['auth', 'role:user',]], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user-dashboard');
    Route::post('pending-orders/{order}', [UserController::class, 'cancelorder'])->name('cancelorder');
    Route::get('/products_list', [ProductController::class, 'productlist'])->name('product-list');
    Route::get('/products_details/{product}', [ProductController::class, 'showdetails'])->name('showdetails');
    Route::post('/products_details/cart/{product}', [CartController::class, 'addToCartDetails'])->name('cart_add');

    // profile update route
    Route::get('/my_profile', [UserController::class, 'userprofile'])->name('userprofile');
    Route::post('/my_profile/update', [UserController::class, 'updateprofile'])->name('updateprofile');
    Route::post('/check-unique-fullname', [UserController::class, 'checkUniqueFullName'])->name('checkUniqueFullName');
    Route::post('/check-unique-email', [UserController::class, 'checkUniqueEmail'])->name('checkUniqueEmail');
    Route::post('/my_profile/password', [UserController::class, 'updatepassword'])->name('updatepassword');
    Route::post('/check-current-password', [UserController::class, 'checkCurrentPass'])->name('checkCurrentPass');

    Route::get('/shipping_address', [UserController::class, 'ShippingAddress'])->name('shippingaddress');
    Route::get('/change_password', [UserController::class, 'changepassword'])->name('changepassword');

    // order
    Route::get('/invoice/{order}', [UserController::class, 'invoice'])->name('invoice');
    Route::post('/upload_payment_slip/{order}', [UserController::class, 'uploadpayment'])->name('uploadpayment');

    Route::get('/search-orders', [OrderController::class, 'searchOrders'])->name('search.orders');
    Route::get('/get-user-purchase-wallet-balance', [OrderController::class, 'getUserPurchaseWalletBalance'])->name('get-user-purchase-wallet-balance');

    // Wallets
    Route::get('deposit', [PaymentController::class, 'purchaseWalletDeposit'])->name('member.deposit');
    Route::get('topup', [PaymentController::class, 'purchaseWalletTopup'])->name('member.topup');
    Route::post('topup', [PaymentController::class, 'purchaseWalletTopupStore'])->name('member.topup.store');
    Route::get('withdraw', [PaymentController::class, 'purchaseWalletWithdraw'])->name('member.withdraw');
    Route::post('withdraw', [PaymentController::class, 'purchaseWalletWithdrawStore'])->name('member.withdraw.store');
});

// Route::get('dependent-dropdown', [DropdownController::class, 'index']);
// Route::post('api/fetch-states', [DropdownController::class, 'fetchState']);
// Route::post('api/fetch-cities', [DropdownController::class, 'fetchCity']);

// ADMIN
Route::group(['prefix' => 'admin',  'middleware' => ['auth', 'role:superadmin|admin',]], function () {
    // dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');

    // announcements
    Route::get('/announcements', [AnnouncementController::class, 'list'])->name('announcements.list');
    Route::get('/announcements/add', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');

    // order
    Route::get('/orders', [AdminController::class, 'orderListing'])->name('orders.listing');
    Route::post('/orders/{order}/reject', [AdminController::class, 'reject'])->name('orders.rejectorder');
    Route::post('/orders/{order}/pack', [AdminController::class, 'packing'])->name('orders.packing');

    // product
    Route::get('product_listing', [ProductController::class, 'listing'])->name('list');
    Route::post('product_listing', [ProductController::class, 'store'])->name('store');
    Route::get('create_product', [ProductController::class, 'create'])->name('create');
    Route::get('/product_detail/{product}', [ProductController::class, 'show'])->name('show');
    Route::get('/product_detail/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::delete('/product_detail/remove-picture/{product}', [ProductController::class, 'removePicture'])->name('remove-picture');
    Route::post('/product_detail/update/{product}', [ProductController::class, 'update'])->name('update');
    Route::post('/product_detail/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');

    // members
    Route::get('/members', [AdminController::class, 'memberList'])->name('member-list');
    Route::get('/members/{user}/edit', [AdminController::class, 'memberEdit'])->name('members.edit');
    Route::get('/members/{address}/set-default/{user}', [AdminController::class, 'setDefaultAddress'])->name('setDefaultAddress');
    Route::post('/members/update', [AdminController::class, 'memberUpdate'])->name('members.update');
    Route::delete('/members/{user}/destroy', [AdminController::class, 'memberDestroy'])->name('members.destroy');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('order-history-list');

    Route::get('/invoice/{order}', [AdminController::class, 'invoice'])->name('invoice-admin');

    Route::get('member-network-tree', [UserController::class, 'memberNetworkTree'])->name('admin.network-tree');



    // Wallets
    Route::get('/pending-deposit', [PaymentController::class, 'pendingDeposit'])->name('admin.pending-deposit');
    Route::get('/pending-withdrawal', [PaymentController::class, 'pendingWithdrawal'])->name('admin.pending-withdrawal');

    Route::get('cash-wallet', [AdminController::class, 'cashWallet'])->name('admin.cash-wallet');
    Route::get('product-wallet', [AdminController::class, 'productWallet'])->name('admin.product-wallet');

    // Profile
    Route::get('my-profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('my-profile/update', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
    Route::post('/check-unique-id', [AdminController::class, 'checkUniqueID'])->name('admin.registerUniqueID');
    Route::post('/check-unique-username', [AdminController::class, 'checkUniqueUsername'])->name('admin.registerUniqueUsername');
    Route::post('/check-unique-email', [AdminController::class, 'checkUniqueEmail'])->name('admin.registerUniqueEmail');
    Route::post('/check-unique-contact', [AdminController::class, 'checkUniqueContact'])->name('admin.registerUniqueContact');

    Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('change-password/{user}', [HomeController::class, 'updatePassword'])->name('admin.updatePassword');
    Route::post('/check-current-password', [UserController::class, 'checkCurrentPass'])->name('admin.checkCurrentPass');
});

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
