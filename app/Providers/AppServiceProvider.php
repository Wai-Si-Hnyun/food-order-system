<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Services
        $this->app->bind('App\Contracts\Services\AuthServiceInterface', 'App\Services\AuthService');
        $this->app->bind('App\Contracts\Services\ProductServiceInterface', 'App\Services\ProductService');
        $this->app->bind('App\Contracts\Services\CategoryServiceInterface', 'App\Services\CategoryService');
        $this->app->bind('App\Contracts\Services\OrderServiceInterface', 'App\Services\OrderService');
        $this->app->bind('App\Contracts\Services\LocationServiceInterface', 'App\Services\LocationService');
        $this->app->bind('App\Contracts\Services\UserProductServiceInterface', 'App\Services\UserProductService');
        $this->app->bind('App\Contracts\Services\WishlistServiceInterface', 'App\Services\WishlistService');
        $this->app->bind('App\Contracts\Services\ReviewServiceInterface', 'App\Services\ReviewService');
        $this->app->bind('App\Contracts\Services\PaymentServiceInterface', 'App\Services\PaymentService');
        $this->app->bind('App\Contracts\Services\MailServiceInterface', 'App\Services\MailService');
        $this->app->bind('App\Contracts\Services\ChatbotServiceInterface', 'App\Services\ChatbotService');
        $this->app->bind('App\Contracts\Services\FeedbackServiceInterface', 'App\Services\FeedbaeckService');
        $this->app->bind('App\Contracts\Services\UserServiceInterface', 'App\Services\UserSrvice');

        //Dao
        $this->app->bind('App\Contracts\Dao\UserProductDaoInterface', 'App\Dao\UserProductDao');
        $this->app->bind('App\Contracts\Dao\AjaxDaoInterface', 'App\Dao\AjaxDao');
        $this->app->bind('App\Contracts\Dao\AuthDaoInterface', 'App\Dao\AuthDao');
        $this->app->bind('App\Contracts\Dao\CategoryDaoInterface', 'App\Dao\CategoryDao');
        $this->app->bind('App\Contracts\Dao\ProductDaoInterface', 'App\Dao\ProductDao');
        $this->app->bind('App\Contracts\Dao\OrderDaoInterface', 'App\Dao\OrderDao');
        $this->app->bind('App\Contracts\Dao\LocationDaoInterface', 'App\Dao\LocationDao');
        $this->app->bind('App\Contracts\Dao\WishlistDaoInterface', 'App\Dao\WishlistDao');
        $this->app->bind('App\Contracts\Dao\ReviewDaoInterface', 'App\Dao\ReviewDao');
        $this->app->bind('App\Contracts\Dao\PaymentDaoInterface', 'App\Dao\PaymentDao');
        $this->app->bind('App\Contracts\Dao\ChatbotDaoInterface', 'App\Dao\ChatbotDao');
        $this->app->bind('App\Contracts\Dao\FeedbackDaoInterface', 'App\Dao\FeedbackDao');
        $this->app->bind('App\Contracts\Dao\UserDaoInterface', 'App\Dao\UserDao');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
