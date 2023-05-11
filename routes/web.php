<?php

use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.layouts.app');
});

// for users
Route::get('/users', [UserController::class, 'home'])->name('users.home');
Route::get('/users/shop', [UserController::class, 'shop'])->name('users.shop');

// ajax
Route::get('/ajax/products', [AjaxController::class, 'index'])->name('ajax.index');
