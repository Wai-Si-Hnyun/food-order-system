<?php

use Illuminate\Support\Facades\Route;

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
    return view('admin.layouts.app');
});

Route::middleware(['role:user'])->group(function () {
    //Define user routes here
});

Route::middleware(['role:admin'])->group(function () {
    //Define admin routes here
});