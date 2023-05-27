<?php

namespace App\Http\Controllers;

use App\Contracts\Services\WishlistServiceInterface;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * wishlist interface
     */

    private $wishlistService;
    /**
     * Create a new controller instance.
     * @param WishlistServiceInterface $wishlistServiceInterface
     * @return void
     */
    public function __construct(WishlistServiceInterface $wishlistServiceInterface)
    {
        $this->wishlistService = $wishlistServiceInterface;
    }
    /**
     * function wishlist
     */
    public function addWishlist()
    {
        $wishlists = $this->wishlistService->getWishlists();

        return view('user.main.wishlist', compact('wishlists'));

    }

    public function storeWishlist(Request $request)
    {
        $this->wishlistService->createWishlist($request->all());

        return response()->json(['message' => 'Success'], 200);
    }

    /**
     * Delete wishlist by id
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteWishlistById(int $id)
    {
        $this->wishlistService->deleteWishlistById($id);

        return response()->json(['message' => 'Success'], 200);
    }

    /**
     * Delete wishlist by product id and user id
     *
     * @param integer $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteWishlistByProductId(int $productId)
    {
        $this->wishlistService->deleteWishlistByProductId($productId);

        return response()->json(['message' => 'Success'], 200);
    }
}
