<?php

use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
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

// for users
Route::get('/users', [UserController::class, 'home'])->name('users.home');
Route::get('/users/shop', [UserController::class, 'shop'])->name('users.shop');
Route::get('/users/filter/{id}', [UserController::class, 'filter'])->name('users.filter');
Route::get('/users/details/{id}', [UserController::class, 'details'])->name('users.details');

// ajax
Route::get('/ajax/products', [AjaxController::class, 'index'])->name('ajax.index');
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
    Route::get('/payment/status', [PaymentController::class, 'status']);
});

Route::middleware('role:admin')->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

    // for category
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
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
    Route::delete('admin/order/{id}/delete', [OrderController::class, 'destroy'])->name('order.delete');
    Route::get('/admin/order/{id}/status/change', [OrderController::class, 'changeStatus']);
});
