<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserdataController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserProductController;

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

// Chat bot
Route::post('/chat/get-answer', [ChatbotController::class, 'getAnswer']);

    //Customer Care
    Route::get('/customer-care',[CustomerController::class,'care'])->name('customer.care');

Route::middleware('role:user')->group(function () {
    // Order
    Route::post('/order/create', [OrderController::class, 'store'])->name('order.store');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');

    // Payment
    Route::get('/payment/choose', [PaymentController::class, 'index'])->name('user.payment');
    Route::get('/payment/card', [PaymentController::class, 'card'])->name('payment.card');
    Route::post('/payment/card', [PaymentController::class, 'chargeCard'])->name('stripe.card');
    Route::get('/payment/google-pay', [PaymentController::class, 'google'])->name('payment.google');
    Route::post('/payment/google-pay', [PaymentController::class, 'chargeGooglePay'])->name('stripe.google');

    // for users
    Route::get('/users', [UserProductController::class, 'home'])->name('users.home');
    Route::get('/shop', [HomeController::class, 'shop'])->name('users.shop');
    Route::get('/users/{id}/filter', [UserProductController::class, 'filter'])->name('users.filter');
    Route::get('/users/{id}/details', [UserProductController::class, 'details'])->name('users.details');

    // for wishlists
    Route::get('/users/wishlists', [WishlistController::class, 'addWishlist'])->name('users.wishlist');

    // ajax
    Route::get('/ajax/products', [AjaxController::class, 'index'])->name('ajax.index');

    //cart
    Route::post('add-cart/{product}', [CartController::class, 'addToCart'])->name('add.cart');
    Route::get('/cart', [CartController::class, 'cart'])->name('show.cart');
    Route::delete('/deleteCart/{id}', [CartController::class, 'remove'])->name('remove.cart');
    Route::post('update-cart/{product}',[CartController::class, 'updateCart'])->name('update.cart');

    //reviews
    Route::post('/review', [ReviewController::class, 'review'])->name('review.create');
    Route::get('/review/{review}/edit', [ReviewController::class, 'reviewEdit'])->name('review.edit');
    Route::put('/review/{review}', [ReviewController::class, 'reviewUpdate'])->name('review.update');
    Route::delete('/review-delete/{review}', [ReviewController::class, 'reviewDelete'])->name('review.delete');

    //feedback
    Route::get('/feed-back',[FeedbackController::class,'feedback'])->name('feedback.page');
    Route::post('/feedback-create',[FeedbackController::class,'feedbackCreate'])->name('feedback.create');
});

//Route::middleware('role:admin')->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

    // for category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // for product
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/details', [ProductController::class, 'detail'])->name('products.details');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/{id}/update', [ProductController::class, 'destroy'])->name('products.destroy');

    // Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}/show', [OrderController::class, 'show'])->name('order.show');
    Route::delete('/orders/{id}/delete', [OrderController::class, 'destroy'])->name('order.delete');
    Route::get('/orders/{id}/status/change', [OrderController::class, 'changeOrderStatus']);
    Route::get('/orders/{id}/deivered/status/change', [OrderController::class, 'changeDeliverStatus']);

    //review
    Route::get('/reviews/list',[ReviewController::class,'reviewList'])->name('review.list');
    Route::delete('/user-review/{review}',[ReviewController::class,'reviewDestory'])->name('review.destory');

    //UserList
    Route::get('/users/list', [UserdataController::class, 'userList'])->name('userData.list');
    Route::put('/user/{user}', [UserdataController::class, 'roleUpdate'])->name('role.update');
    Route::get('/user/{user}/info', [UserdataController::class, 'userInfo'])->name('user.info');
    Route::delete('/user-delete/{user}', [UserdataController::class, 'userDelete'])->name('user.destory');

    //feedback
    Route::get('/feedback-list',[FeedbackController::class,'feedbackList'])->name('feedback.list');
    Route::delete('/feedback-delete/{feedback}',[FeedbackController::class,'feedbackDestory'])->name('feedback.destory');

    // Mail
    Route::get('/mail', [MailController::class, 'index'])->name('mail.index');
    Route::post('/mail/send', [MailController::class, 'send'])->name('mail.send');

    // Questions and Answers
    Route::get('/questions-and-answers', [ChatbotController::class, 'index'])->name('q&a.index');
    Route::get('/questions-and-answers/create', [ChatbotController::class, 'create'])->name('q&a.create');
    Route::post('/questions-and-answers/store', [ChatbotController::class, 'store'])->name('q&a.store');
//});

//userProfile (for admin and user)
Route::get('/userprofile/{user}',[UserdataController::class,'userProfile'])->name('user.profile');
Route::post('/profile-update/{user}',[UserdataController::class,'profileUpdate'])->name('profile.update');
Route::get('/password/{user}',[UserdataController::class,'passChange'])->name('pass.change');
Route::post('/pass-change',[UserdataController::class,'passwordUpdate'])->name('password.change');
Route::delete('/delete-account/{user}',[UserdataController::class,'accountDelete'])->name('account.destroy');
