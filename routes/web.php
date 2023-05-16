<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserProductController;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
//     Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
// });

Route::get('/', [HomeController::class, 'home'])->name('home');

//login/register
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('auth.registerPage');
Route::post('/register', [AuthController::class, 'authRegisterStore'])->name('auth.store');
Route::post('/login', [AuthController::class, 'authLogin'])->name('auth.loginCheck');

Route::middleware('role:user')->group(function () {
    // Order
    Route::post('user/order/create', [OrderController::class, 'store'])->name('order.store');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');

    // Payment
    Route::get('/payment/choose', [PaymentController::class, 'index'])->name('user.payment');
    Route::get('/payment/card', [PaymentController::class, 'card'])->name('payment.card');
    Route::post('/payment/card', [PaymentController::class, 'chargeCard'])->name('stripe.card');
    Route::get('/payment/google-pay', [PaymentController::class, 'google'])->name('payment.google');
    Route::post('/payment/google-pay', [PaymentController::class, 'chargeGooglePay'])->name('stripe.google');

    // for users
    Route::get('/users', [UserProductController::class, 'home'])->name('users.home');
    Route::get('/users/shop', [UserProductController::class, 'shop'])->name('users.shop');
    Route::get('/users/filter/{id}', [UserProductController::class, 'filter'])->name('users.filter');
    Route::get('/users/details/{id}', [UserProductController::class, 'details'])->name('users.details');

    // ajax
    Route::get('/ajax/products', [AjaxController::class, 'index'])->name('ajax.index');
});

Route::middleware('role:admin')->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

    // for category
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // for product
    Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/product/details/{id}', [ProductController::class, 'detail'])->name('products.details');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Order
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/admin/order/{id}/show', [OrderController::class, 'show'])->name('order.show');
    Route::delete('admin/orders/{id}/delete', [OrderController::class, 'destroy'])->name('order.delete');
    Route::get('/admin/orders/{id}/status/change', [OrderController::class, 'changeOrderStatus']);
    Route::get('/admin/orders/{id}/deivered/status/change', [OrderController::class, 'changeDeliverStatus']);
});
