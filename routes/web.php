<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Member\UserController;
use App\Http\Controllers\admin\AdminController;

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

//Update User Details
Route::get('/my-profile',[App\Http\Controllers\HomeController::class, 'myProfile'])->name('myProfile');
Route::post('/update-profile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-address', [App\Http\Controllers\HomeController::class, 'updateAddress'])->name('updateAddress');
Route::post('/toggle-default-address', [App\Http\Controllers\HomeController::class, 'toggleDefaultAddress'])->name('toggleDefaultAddress');
Route::post('/update-bank', [App\Http\Controllers\HomeController::class, 'updateBank'])->name('updateBank');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


/**
 * MEMBERS
 */
Route::group(['prefix' => 'members',  'middleware' => ['auth', 'role:user',]], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Route::get('/', [MemberController::class, 'index'])->name('members.index');                                     // member Index
    // Route::get('/create', [MemberController::class, 'create'])->name('members.create');                             // member CREATE
    // Route::get('/delete/{customer}', [MemberController::class, 'delete'])->name('members.delete');                  // member DELETE
    // Route::get('/show/{customer}', [MemberController::class, 'show'])->name('members.show');                        // member SHOW
    // Route::get('/edit/{customer}', [MemberController::class, 'edit'])->name('members.edit');                        // member EDIT
    // Route::post('/', [MemberController::class, 'store'])->name('members.store');                                    // store
    // Route::post('/update/{customer}', [MemberController::class, 'update'])->name('members.update');                 // update
    // Route::post('/destroy/{customer}', [MemberController::class, 'destroy'])->name('members.destroy');              // destroy
    Route::post('pending-orders/{order}', [UserController::class, 'cancelorder'])->name('cancelorder');
    Route::get('/products_list', [ProductController::class, 'productlist'])->name('product-list');

    Route::get('/products_details/{product}', [ProductController::class, 'showdetails'])->name('showdetails');
    Route::post('/products_details/cart/{product}', [CartController::class, 'addToCartDetails'])->name('cart_add');

});
/**
 * PRODUCTS
 */
Route::group(['prefix' => 'consumer/products',  'middleware' => 'auth'], function () {
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');                           // product CREATE
    Route::get('/delete/{product}', [ProductController::class, 'delete'])->name('products.delete');                 // product DELETE
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');                            // product SHOW
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');                       // product EDIT
    Route::post('/update/{product}', [ProductController::class, 'update'])->name('products.update');                // update
    Route::post('/destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy');             // destroy
});


// Route::get('/announcement/index', [AnnouncementController::class, 'index'])->name('announcements.index');


Route::get('dependent-dropdown', [DropdownController::class, 'index']);
Route::post('api/fetch-states', [DropdownController::class, 'fetchState']);
Route::post('api/fetch-cities', [DropdownController::class, 'fetchCity']);

// ADMIN
Route::group(['prefix' => 'admin',  'middleware' => ['auth', 'role:superadmin|admin',]], function () {
    // dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // announcements
    Route::get('/announcements', [AnnouncementController::class, 'list'])->name('announcements.list');
    Route::get('/announcements/add', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');

    // order
    Route::get('/orders/listing', [AdminController::class, 'allorder'])->name('new-order-list');
    Route::post('/orders/listing/{order}/reject', [AdminController::class, 'reject'])->name('rejectorder');
    Route::post('/orders/listing/{order}/pack', [AdminController::class, 'packing'])->name('packing');

    // product
    Route::get('product_listing', [ProductController::class, 'listing'])->name('list');
    Route::post('product_listing', [ProductController::class, 'store'])->name('store');
    Route::get('create_product', [ProductController::class, 'create'])->name('create');
    Route::get('/product_detail/{product}', [ProductController::class, 'show'])->name('show');
    Route::get('/product_detail/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::post('/product_detail/update/{product}', [ProductController::class, 'update'])->name('update');
    Route::post('/product_detail/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');

    // members
    Route::get('/members', [AdminController::class, 'memberList'])->name('member-list');
    Route::get('/members/{user}/edit', [AdminController::class, 'memberEdit'])->name('members.edit');
    Route::get('/members/{address}/set-default/{user}', [AdminController::class, 'setDefaultAddress'])->name('setDefaultAddress');
    Route::post('/members/update', [AdminController::class, 'memberUpdate'])->name('members.update');
    Route::get('/members/{user}/destroy', [AdminController::class, 'memberDestroy'])->name('members.destroy');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('order-history-list');


});

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
