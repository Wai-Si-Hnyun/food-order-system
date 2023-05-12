<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\UserServiceInterface;
use App\Http\Controllers\Controller;

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
        // $products = Product::get();
        $products = $this->userService->getUsers();
        return view('user.main.home', compact('products'));
    }
    /**
     * shop function
     */
    public function shop()
    {
        $products = $this->userService->getUsers();
        $categories = $this->userService->getUsers();
        return view('user.main.shop', compact('products', 'categories'));
    }

    /**
     * filter function
     */
    public function filter($id)
    {
        // $products = Product::where('category_id', $id)->orderBy('created_at', 'desc')->get();
        // $categories = Category::get();
        $products = $this->userService->getUserById($id);
        $categories = $this->userService->getUserById($id);

        return view('user.main.shop', compact('products', 'categories'));

    }
}
