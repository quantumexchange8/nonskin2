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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
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
});
/**
 * PRODUCTS
 */
Route::group(['prefix' => 'manage/products',  'middleware' => 'auth'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');                                   // product Index
    Route::get('/list', [ProductController::class, 'list'])->name('products.list');                                 // product List
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');                           // product CREATE
    Route::get('/delete/{product}', [ProductController::class, 'delete'])->name('products.delete');                 // product DELETE
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');                            // product SHOW
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');                       // product EDIT
    Route::post('/', [ProductController::class, 'store'])->name('products.store');                                  // store
    Route::post('/update/{product}', [ProductController::class, 'update'])->name('products.update');                // update
    Route::post('/destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy');             // destroy
});

Route::post('/add-member', [RegisterController::class, 'store'])->name('add.member');

Route::get('dependent-dropdown', [DropdownController::class, 'index']);
Route::post('api/fetch-states', [DropdownController::class, 'fetchState']);
Route::post('api/fetch-cities', [DropdownController::class, 'fetchCity']);
