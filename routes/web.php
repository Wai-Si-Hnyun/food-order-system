<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\UserdataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\FeedbackController;

Route::get('/', [HomeController::class, 'home'])->name('home');

//login/register
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('auth.registerPage');
Route::post('/register', [AuthController::class, 'authRegisterStore'])->name('auth.store');
Route::post('/login', [AuthController::class, 'authLogin'])->name('auth.loginCheck');

//forget/reset password
Route::get('/forget-password-page', [AuthController::class, 'forgetPass'])->name('auth.forgetPass');
Route::post('/forget-create', [AuthController::class, 'forgetCreate'])->name('auth.forgetCreate');
Route::get('/reset-password-page', [AuthController::class, 'resetPass'])->name('auth.resetPass');
Route::post('/pass-change', [AuthController::class, 'passChange'])->name('auth.passChange');

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
    Route::get('/users/{id}', [UserProductController::class, 'home'])->name('users.home');
    Route::get('/users/shop', [UserProductController::class, 'shop'])->name('users.shop');
    Route::get('/users/filter/{id}', [UserProductController::class, 'filter'])->name('users.filter');
    Route::get('/users/details/{id}', [UserProductController::class, 'details'])->name('users.details');

    // for wishlists
    Route::get('/users/wishlists', [WishlistController::class, 'addWishlist'])->name('users.wishlist');

    // ajax
    Route::get('/ajax/products', [AjaxController::class, 'index'])->name('ajax.index');

    //cart
    Route::post('add-cart/{product}', [CartController::class, 'addToCart'])->name('add.cart');
    Route::get('cart', [CartController::class, 'cart'])->name('show.cart');
    Route::delete('/deleteCart/{id}', [CartController::class, 'remove'])->name('remove.cart');

    //reviews
    Route::post('/review', [ReviewController::class, 'review'])->name('review.create');
    Route::get('/review/{review}/edit', [ReviewController::class, 'reviewEdit'])->name('review.edit');
    Route::put('/review/{review}', [ReviewController::class, 'reviewUpdate'])->name('review.update');
    Route::delete('/review-delete/{review}', [ReviewController::class, 'reviewDelete'])->name('review.delete');

    //feedback
    Route::get('/feed-back',[FeedbackController::class,'feedback'])->name('feedback.page');
    Route::post('/feedback-create',[FeedbackController::class,'feedbackCreate'])->name('feedback.create');
});

Route::middleware('role:admin')->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

    // for category
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create/categories', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // for product
    Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/product/{id}/details', [ProductController::class, 'detail'])->name('products.details');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.destroy');

    // Order
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/admin/order/{id}/show', [OrderController::class, 'show'])->name('order.show');
    Route::delete('admin/orders/{id}/delete', [OrderController::class, 'destroy'])->name('order.delete');
    Route::get('/admin/orders/{id}/status/change', [OrderController::class, 'changeOrderStatus']);
    Route::get('/admin/orders/{id}/deivered/status/change', [OrderController::class, 'changeDeliverStatus']);

    //review
    Route::get('/review-list', [ReviewController::class, 'reviewList'])->name('review.list');
    Route::delete('/user-review/{review}', [ReviewController::class, 'reviewDestory'])->name('review.destory');

    //UserList
    Route::get('/user-list', [UserdataController::class, 'userList'])->name('userData.list');
    Route::put('/user/{user}', [UserdataController::class, 'roleUpdate'])->name('role.update');
    Route::get('/user/{user}/info', [UserdataController::class, 'userInfo'])->name('user.info');
    Route::delete('/user-delete/{user}', [UserdataController::class, 'userDelete'])->name('user.destory');

    // Mail
    Route::get('/admin/mail', [MailController::class, 'index'])->name('mail.index');
    Route::post('/admin/mail/send', [MailController::class, 'send'])->name('mail.send');
  
    //feedback
    Route::get('/feedback-list',[FeedbackController::class,'feedbackList'])->name('feedback.list');
    Route::delete('/feedback-delete/{feedback}',[FeedbackController::class,'feedbackDestory'])->name('feedback.destory');
});
