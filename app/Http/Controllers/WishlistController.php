<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\WishlistServiceInterface;

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

        $products = Product::select('id', 'name', 'image', 'price')->get();
        $wishlists = $this->wishlistService->getWishlists();
        return view('user.main.wishlist', compact('wishlists', 'products'));
    }

    public function storeWishlist($productId)
    {
        Wishlist::create([
            'product_id' => $productId,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('users.details', $productId);
    }

    public function destroyWishlist($id)
    {
        $this->wishlistService->deleteWishlistById($id);
        return redirect()->route('users.wishlist')->with(['deleteSuccess' => 'Wishlist delete successfully!']);
    }
}