<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\UserController;

Route::group(['prefix' => 'admin/', 'as' => 'admin.',  'middleware' => 'auth'], function () {
    Route::get('member-list', [UserController::class, 'memberList'])->name('member-list');

});
