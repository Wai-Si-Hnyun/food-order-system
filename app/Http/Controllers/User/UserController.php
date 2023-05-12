<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class UserController extends Controller
{
    /**
     * user interface
     */

    private $userService;
    /**
     * Create a new controller instance.
     * @param UserServiceInterface $userServiceInterface
     * @return void
     */
    public function __construct(UserServiceInterface $userServiceInterface)
    {
        $this->userService = $userServiceInterface;
    }
    /**
     * home function
     */
    public function home()
    {
        $products = $this->userService->getUsers();
        return view('user.main.home', compact('products'));
    }
    /**
     * shop function
     */
    public function shop()
    {
        $products = $this->userService->getUsers();
        $categories = Category::get();
        return view('user.main.shop', compact('products', 'categories'));
    }

    /**
     * shop details function
     */
    public function details($id)
    {
        $products = Product::where('id', $id)->first();
        $productList = Product::get();
        return view('user.main.details', compact('products', 'productList'));
    }

    /**
     * filter function
     */
    public function filter($id)
    {
        $products = $this->userService->getUserById($id);
        $categories = $this->userService->getUserById($id);
        return view('user.main.shop', compact('products', 'categories'));

    }
}
