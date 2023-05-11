<?php

use App\Http\Controllers\ProductController;

use App\Http\Controllers\CategoryController;
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

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
});

//login/register
Route::get('/',[AuthController::class,'login'])->name('auth#login');
Route::get('/registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');

Route::post('/Registerstore',[AuthController::class,'authRegisterStore'])->name('auth#store');
Route::post('/loginStore',[AuthController::class,'authLogin'])->name('auth#loginCheck');

Route::prefix('category')->middleware('auth')->group(function(){
    Route::get('list',[CategoryController::class,'list'])->name('category#list');
});

Route::get('/', function () {
    return view('admin.layouts.app');
});

// for category
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// for product
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/product/details/{id}', [ProductController::class, 'detail'])->name('products.details');
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::get('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Order
Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders#index');
Route::post('/order/create', [OrderController::class, 'store'])->name('order.store');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/payment/status', [PaymentController::class, 'status']);

Route::middleware(['role:user'])->group(function () {
    //Define user routes here
});

Route::middleware(['role:admin'])->group(function () {
    //Define admin routes here
});
