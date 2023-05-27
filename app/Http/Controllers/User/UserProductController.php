<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\ProductServiceInterface;
use App\Contracts\Services\WishlistServiceInterface;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\ReviewServiceInterface;
use App\Contracts\Services\UserProductServiceInterface;

class UserProductController extends Controller
{
    /**
     * user interface
     */

    private $userProductService;
    private $reviewService;
    private $productService;
    private $wishlistService;

    /**
     * Create a new controller instance.
     * @param UserProductServiceInterface $userServiceInterface
     * @return void
     */
    public function __construct(
        UserProductServiceInterface $userProductServiceInterface,
        ReviewServiceInterface $reviewServiceInterface,
        ProductServiceInterface $productService,
        WishlistServiceInterface $wishlistService
    ) {
        $this->userProductService = $userProductServiceInterface;
        $this->reviewService = $reviewServiceInterface;
        $this->productService = $productService;
        $this->wishlistService = $wishlistService;
    }

    /**
     * shop details function
     * 
     * @param integer $id
     * @return \Illuminate\Contracts\View\View
     */
    public function details($id)
    {
        $user = Auth::user();
        $review = $this->reviewService->reviewShow($id);
        $product = $this->productService->getProductById($id);
        $relatedProducts = $this->productService->getRelatedProducts($id);
        $isWishlist = $user ? $this->wishlistService->checkWishlist($user->id, $id) : false;

        return view('user.main.details', compact('product', 'relatedProducts','review', 'isWishlist'));
    }

    /**
     * filter function
     */
    public function filter($id)
    {
        $products = $this->userProductService->getUserProductById($id);

        return response()->json($products, 200);
    }
}
