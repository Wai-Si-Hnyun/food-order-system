<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\UserProductServiceInterface;
use App\Contracts\Services\ReviewServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class UserProductController extends Controller
{
    /**
     * user interface
     */

    private $userProductService;
    private $reviewServiceInterface;
    /**
     * Create a new controller instance.
     * @param UserProductServiceInterface $userServiceInterface
     * @return void
     */
    public function __construct(UserProductServiceInterface $userProductServiceInterface,ReviewServiceInterface $reviewServiceInterface)
    {
        $this->userProductService = $userProductServiceInterface;
        $this->reviewService = $reviewServiceInterface;
    }
    /**
     * home function
     */
    public function home($id)
    {
        $user = session()->get('user',[]);
        $user[$id] = [
            "user_id"=> $id
        ];
        session()->put('user',$user);
        $products = $this->userProductService->getUsersProduct();
        return view('user.main.home', compact('products'));
    }
    /**
     * shop function
     */
    public function shop()
    {
        $products = $this->userProductService->getUsersProduct();
        $categories = Category::get();
        return view('user.main.shop', compact('products', 'categories'));
    }

    /**
     * shop details function
     */
    public function details($id)
    {
        $user = session()->get('user');

        $review = $this->reviewService->reviewShow($id);
        $products = Product::where('id', $id)->first();
        $productList = Product::get();
        return view('user.main.details', compact('products', 'productList', 'id', 'user','review'));
    }

    /**
     * filter function
     */
    public function filter($id)
    {
        $products = $this->userProductService->getUserProductById($id);
        $categories = $this->userProductService->getUserProductById($id);
        return view('user.main.shop', compact('products', 'categories'));

    }
}
