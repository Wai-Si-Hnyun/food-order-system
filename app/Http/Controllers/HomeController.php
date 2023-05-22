<?php

namespace App\Http\Controllers;

use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\CategoryServiceInterface;
use App\Contracts\Services\OrderServiceInterface;
use App\Contracts\Services\ProductServiceInterface;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\ChatbotServiceInterface;
use App\Contracts\Services\UserProductServiceInterface;

class HomeController extends Controller
{
    private $userProductService;
    private $categoryService;
    private $productService;
    private $orderService;
    private $chatbotService;
    private $userDao;

    public function __construct(
        UserProductServiceInterface $userProductService,
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService,
        UserDaoInterface $userDao,
        OrderServiceInterface $orderService,
        ChatbotServiceInterface $chatbotService
    ) {
        $this->userProductService = $userProductService;
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->userDao = $userDao;
        $this->orderService = $orderService;
        $this->chatbotService = $chatbotService;
    }

    /**
     * Go to home page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function home()
    {
        $products = $this->userProductService->getUsersProduct();
        $questions = $this->chatbotService->getAllQuestions();

        return view('user.main.home', compact('products', 'questions'));
    }

    /**
     * Go to admin dashboard page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function adminDashboard()
    {
        $totalCategories = count($this->categoryService->getCategory('admin'));
        $totalProducts = count($this->productService->getProduct('admin'));
        $totalUsers = count($this->userDao->getUsersByRole('user'));
        $totalOrders = count($this->orderService->index());
        $deliveredOrders = count($this->orderService->getDeliveredOrders());
        $processingOrders = $totalOrders - $deliveredOrders;
        $totalRevenue = $this->orderService->getTotalRevenue();
        $currentMonthRevenue = $this->orderService->getMonthlyRevenueInfo()['currentMonthRevenue'];
        $percentageChangePerMonth = $this->orderService->getMonthlyRevenueInfo()['percentageChange'];
        $currentYearRevenue = $this->orderService->getYearlyRevenueInfo()['currentYearRevenue'];
        $percentageChangePerYear = $this->orderService->getYearlyRevenueInfo()['percentageChange'];

        $data = [
            'totalCategories' => $totalCategories,
            'totalProducts' => $totalProducts,
            'totalUsers' => $totalUsers,
            'totalOrders' => $totalOrders,
            'deliveredOrders' => $deliveredOrders,
            'processingOrders' => $processingOrders,
            'totalRevenue' => $totalRevenue,
            'currentMonthRevenue' => $currentMonthRevenue,
            'percentageChangePerMonth' => $percentageChangePerMonth,
            'currentYearRevenue' => $currentYearRevenue,
            'percentageChangePerYear' => $percentageChangePerYear,
        ];

        return view('admin.pages.dashboard', compact('data'));
    }

    public function shop()
    {
        $products = $this->userProductService->getUsersProduct();
        $categories = $this->categoryService->getCategory('user');

        return view('user.main.shop', compact('products', 'categories'));
    }

    public function about()
    {
        return view('user.main.about');
    }
}