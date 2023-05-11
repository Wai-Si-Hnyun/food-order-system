<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Models\Order;
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

// Order
Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders#index');
Route::post('/order/create', [OrderController::class, 'store'])->name('order.store');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/payment/status', [PaymentController::class, 'status']);

Route::middleware(['role:user'])->group(function () {
    //Define user routes here
});

Route::middleware(['role:admin'])->group(function () {
    //Order routes
});