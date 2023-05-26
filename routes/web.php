<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

// Unauthenticated Routes
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('users.shop');
Route::get('/products', [ProductController::class, 'getAllProducts'])->name('products.all');
Route::post('/ajax/products', [AjaxController::class, 'index'])->name('ajax.index');
Route::get('/products/{id}/filter', [UserProductController::class, 'filter'])->name('products.filter');
Route::get('/products/{id}/details', [UserProductController::class, 'details'])->name('product.details');
Route::get('/about', [HomeController::class, 'about'])->name('products.about');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart.index');

//login/register
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('auth.registerPage');
Route::post('/register', [AuthController::class, 'authRegisterStore'])->name('auth.store');
Route::post('/login-check', [AuthController::class, 'authLogin'])->name('auth.loginCheck');


//forget/reset password
Route::get('/forget-passwordpage', [AuthController::class, 'forgetPass'])->name('auth.forgetPass');
Route::post('/forget-create', [AuthController::class, 'forgetCreate'])->name('auth.forgetCreate');
Route::get('/reset-passwordpage', [AuthController::class, 'resetPass'])->name('auth.resetPass');
Route::post('/password-change', [AuthController::class, 'passwordChange'])->name('auth.passwordChange');

// Chat bot
Route::post('/chat/get-answer', [ChatbotController::class, 'getAnswer'])->name('chat.getAnswer');

//Customer Care
Route::get('/customer-care', [CustomerController::class, 'care'])->name('customer.care');

//userProfile (for admin and user)
Route::get('/userprofile/{user}', [UserdataController::class, 'userProfile'])->name('user.profile');
Route::post('/profile-update/{user}', [UserdataController::class, 'profileUpdate'])->name('profile.update');
Route::get('/password/{user}/update', [UserdataController::class, 'passChange'])->name('pass.change');
Route::post('/password-update', [UserdataController::class, 'passwordUpdate'])->name('password.change');
Route::delete('/delete-account/{user}', [UserdataController::class, 'accountDelete'])->name('account.destroy');

Route::middleware('role:user')->group(function () {
    // Order
    Route::post('/order/create', [OrderController::class, 'store'])->name('order.store');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [OrderController::class, 'index'])->name('user.order');

    // Payment
    Route::get('/payment/choose', [PaymentController::class, 'index'])->name('user.payment');
    Route::get('/payment/card', [PaymentController::class, 'card'])->name('payment.card');
    Route::post('/payment/card', [PaymentController::class, 'chargeCard'])->name('stripe.card');
    Route::get('/payment/google-pay', [PaymentController::class, 'google'])->name('payment.google');
    Route::post('/payment/google-pay', [PaymentController::class, 'chargeGooglePay'])->name('stripe.google');

    // for users
    Route::get('/users', [UserProductController::class, 'home'])->name('users.home');

    // for wishlists
    Route::get('/users/wishlists/page', [WishlistController::class, 'addWishList'])->name('users.wishlist');
    // Route::get('/users/store/wishlists/{productId}', [WishlistController::class, 'storeWishlist'])->name('products.storeWishlist');
    Route::post('/users/store/wishlists', [WishlistController::class, 'storeWishlist'])->name('products.storeWishlist');
    Route::delete('/users/destroy/{id}/wishlists', [WishlistController::class, 'destroyWishlist'])->name('products.destroyWishlist');

    //reviews
    Route::post('/review', [ReviewController::class, 'review'])->name('review.create');
    Route::get('/review/{review}/edit', [ReviewController::class, 'reviewEdit'])->name('review.edit');
    Route::put('/review/{review}/update', [ReviewController::class, 'reviewUpdate'])->name('review.update');
    Route::delete('/review/{review}/delete', [ReviewController::class, 'reviewDelete'])->name('review.delete');

    //feedback
    Route::get('/feed-back', [FeedbackController::class, 'feedback'])->name('feedback.page');
    Route::post('/feedback-create', [FeedbackController::class, 'feedbackCreate'])->name('feedback.create');
});

Route::middleware('role:admin')->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

    // for category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // for product
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/details', [ProductController::class, 'detail'])->name('products.details');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.destroy');

    // Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}/show', [OrderController::class, 'show'])->name('order.show');
    Route::delete('/orders/{id}/delete', [OrderController::class, 'destroy'])->name('order.delete');

    Route::get('/orders/{id}/status/change', [OrderController::class, 'changeOrderStatus'])->name('order.status.change');
    Route::get('/orders/{id}/deivered/status/change', [OrderController::class, 'changeDeliverStatus'])->name('order.deliver.status.change');

    //review
    Route::get('/reviews/list', [ReviewController::class, 'reviewList'])->name('review.list');
    Route::delete('/reviews/{id}/delete', [ReviewController::class, 'reviewDestory'])->name('review.destory');
    Route::get('/review-search', [ReviewController::class, 'reviewSearch'])->name('review.search');
    Route::get('/review/{review}/show', [ReviewController::class, 'show'])->name('review.show');

    //UserList
    Route::get('/users/list', [UserdataController::class, 'userList'])->name('userData.list');
    Route::put('/user/{user}', [UserdataController::class, 'roleUpdate'])->name('role.update');
    Route::get('/user/{user}/info', [UserdataController::class, 'userInfo'])->name('user.info');
    Route::delete('/user-delete/{user}', [UserdataController::class, 'userDelete'])->name('user.destory');
    Route::get('/search', [UserdataController::class, 'search'])->name('user.search');

    //feedback
    Route::get('/feedback-list', [FeedbackController::class, 'feedbackList'])->name('feedback.list');
    Route::delete('/feedback-delete/{feedback}', [FeedbackController::class, 'feedbackDestory'])->name('feedback.destory');
    Route::get('/feedback-search', [FeedbackController::class, 'feedbackSearch'])->name('feedback.search');
    Route::get('/feedback/{feedback}/show', [FeedbackController::class, 'show'])->name('feedback.show');

    // Mail
    Route::get('/mail', [MailController::class, 'index'])->name('mail.index');
    Route::post('/mail/send', [MailController::class, 'send'])->name('mail.send');

    // Questions and Answers
    Route::get('/questions-and-answers', [ChatbotController::class, 'index'])->name('q&a.index');
    Route::get('/questions-and-answers/create', [ChatbotController::class, 'create'])->name('q&a.create');
    Route::post('/questions-and-answers/store', [ChatbotController::class, 'store'])->name('q&a.store');
    Route::get('/questions-and-answers/{id}/show', [ChatbotController::class, 'show'])->name('q&a.show');
    Route::get('/questions-and-answers/{id}/edit', [ChatbotController::class, 'edit'])->name('q&a.edit');
    Route::put('/questions-and-answers/{id}/update', [ChatbotController::class, 'update'])->name('q&a.update');
    Route::delete('/questions-and-answers/{id}/delete', [ChatbotController::class, 'delete'])->name('q&a.delete');

});
