<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
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

Route::controller(CustomerController::class)->prefix('manage/customers')->as('manage.customers.')->group(function () {
    Route::get('/', 'index')->name('index');
//     Route::get('/url', 'method')->name('name');
//     Route::get('/url', 'method')->name('name');
//     Route::get('/url', 'method')->name('name');
//     Route::get('/url', 'method')->name('name');
//     Route::get('/url', 'method')->name('name');
});
Route::controller(ProductController::class)->prefix('manage/products')->as('manage.products.')->group(function () {
    Route::get('/', 'index')->name('index');
});
Route::controller(OrderController::class)->prefix('manage/orders')->as('manage.orders.')->group(function () {
    Route::get('/', 'index')->name('index');
//     Route::get('/url', 'method')->name('name');
//     Route::get('/url', 'method')->name('name');
//     Route::get('/url', 'method')->name('name');
//     Route::get('/url', 'method')->name('name');
//     Route::get('/url', 'method')->name('name');
});
