<?php

use App\Http\Controllers\OrderController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

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

=======
Route::get('/', function () {
    return view('admin.layouts.app');
});

Route::post('/order/create', [OrderController::class, 'store'])->name('order.store');

Route::middleware(['role:user'])->group(function () {
    //Define user routes here
});

Route::middleware(['role:admin'])->group(function () {
    //Define admin routes here
});
