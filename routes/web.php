<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
Route::resource('cart', CartController::class);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/register/{referral?}', [RegisterController::class, 'register'])->name('register');
Route::post('/add-member', [RegisterController::class, 'store'])->name('add.member');

//Update User Details
Route::get('/my-profile',[App\Http\Controllers\HomeController::class, 'myProfile'])->name('myProfile');
Route::post('/update-profile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-bank', [App\Http\Controllers\HomeController::class, 'updateBank'])->name('updateBank');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

// Route::controller(CustomerController::class)->prefix('customers')->as('manage.customers.')->group(function () {
//     Route::get('/', 'index')->name('index');
// });
// Route::controller(ProductController::class)->prefix('products')->as('manage.products.')->group(function () {
//     Route::get('/', 'index')->name('index');
// });
// Route::controller(OrderController::class)->prefix('orders')->as('manage.orders.')->group(function () {
//     Route::get('/', 'index')->name('index');
// });

/**
 * MEMBERS
 */
Route::group(['prefix' => 'manage/members',  'middleware' => 'auth'], function () {
    Route::get('/', [MemberController::class, 'index'])->name('members.index');                                     // member Index
    Route::get('/create', [MemberController::class, 'create'])->name('members.create');                             // member CREATE
    Route::get('/delete/{customer}', [MemberController::class, 'delete'])->name('members.delete');                  // member DELETE
    Route::get('/show/{customer}', [MemberController::class, 'show'])->name('members.show');                        // member SHOW
    Route::get('/edit/{customer}', [MemberController::class, 'edit'])->name('members.edit');                        // member EDIT
    Route::post('/', [MemberController::class, 'store'])->name('members.store');                                    // store
    Route::post('/update/{customer}', [MemberController::class, 'update'])->name('members.update');                 // update
    Route::post('/destroy/{customer}', [MemberController::class, 'destroy'])->name('members.destroy');              // destroy
    Route::post('pending-orders/{order}', [UserController::class, 'cancelorder'])->name('cancelorder');

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


Route::get('/announcement/index', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/announcement/listing', [AnnouncementController::class, 'list'])->name('announcements.list');
Route::get('/announcement/add', [AnnouncementController::class, 'create'])->name('announcements.create');
Route::post('/announcement', [AnnouncementController::class, 'store'])->name('announcements.store');

Route::get('dependent-dropdown', [DropdownController::class, 'index']);
Route::post('api/fetch-states', [DropdownController::class, 'fetchState']);
Route::post('api/fetch-cities', [DropdownController::class, 'fetchCity']);

// ADMIN
Route::group(['prefix' => 'admin',  'middleware' => ['auth', 'role:superadmin|admin',]], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/orders/listing', [AdminController::class, 'allorder'])->name('new-order-list');
    Route::post('/orders/listing/{order}/reject', [AdminController::class, 'reject'])->name('rejectorder');
    Route::post('/orders/listing/{order}/pack', [AdminController::class, 'packing'])->name('packing');
    // Route::post('/orders/listing/{order}/deliver', [AdminController::class, 'delivering'])->name('delivering');
    // Route::post('/orders/listing/{order}/complete', [AdminController::class, 'complete'])->name('complete');
    // Route::post('/orders/listing/{order}/update', [AdminController::class, 'updatestatus'])->name('updatestatus');

});
