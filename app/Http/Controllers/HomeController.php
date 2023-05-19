<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ChatbotServiceInterface;
use App\Contracts\Services\UserProductServiceInterface;
use App\Services\CategoryService;

class HomeController extends Controller
{
    private $userProductService;
    private $categoryService;
    private $chatbotService;

    public function __construct(
        UserProductServiceInterface $userProductService, 
        CategoryService $categoryService,
        ChatbotServiceInterface $chatbotService
    ) {
        $this->userProductService = $userProductService;
        $this->categoryService = $categoryService;
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
        $user = Auth::user();

        return view('admin.pages.dashboard', compact('user'));
    }

    public function shop()
    {
        $products = $this->userProductService->getUsersProduct('user');
        $categories = $this->categoryService->getCategory('user');

        return view('user.main.shop', compact('products', 'categories'));
    }
}
