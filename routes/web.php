<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserdataController;

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




//login/register/resetpassword
Route::get('/',[AuthController::class,'login'])->name('auth#login');
Route::get('/registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
Route::get('/forgetPasswordPage',[AuthController::class,'forgetPass'])->name('auth#forgetPass');
Route::post('/forgetCreate',[AuthController::class,'forgetCreate'])->name('auth#forgetCreate');
Route::get('/resetPasswordPage',[AuthController::class,'resetPass'])->name('auth#resetPass');
Route::post('/passChange',[AuthController::class,'passChange'])->name('auth#passChange');
Route::post('/Registerstore',[AuthController::class,'authRegisterStore'])->name('auth#store');
Route::post('/loginStore',[AuthController::class,'authLogin'])->name('auth#loginCheck');

//review user
Route::post('/review',[ProductController::class,'review'])->name('review#create');
Route::get('/review/{review}/edit',[ProductController::class,'reviewEdit'])->name('review#edit');
Route::put('/review/{review}',[ProductController::class,'reviewUpdate'])->name('review#update');
Route::delete('/reviewDelete/{review}',[ProductController::class,'reviewDelete'])->name('review#delete');

//review admin
Route::get('/reviewList',[ReviewController::class,'reviewList'])->name('review#list');
Route::delete('/userReview/{review}',[ReviewController::class,'reviewDestory'])->name('review#destory');

//userData admin
Route::get('/userList',[UserdataController::class,'userList'])->name('userData#list');
Route::put('/user/{user}',[UserdataController::class,'roleUpdate'])->name('role#update');
Route::get('/user/{user}/info',[UserdataController::class,'userInfo'])->name('user#info');
Route::delete('/userDelete/{user}',[UserdataController::class,'userDelete'])->name('user#destory');

//userProfile (for admin and user)
Route::get('/userprofile/{user}',[UserdataController::class,'userProfile'])->name('user#profile');

Route::prefix('product')->middleware('auth')->group(function(){
    Route::get('list/{user}',[ProductController::class,'list'])->name('product#list');
});

