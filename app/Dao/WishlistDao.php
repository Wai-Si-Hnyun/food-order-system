<?php

namespace App\Dao;

use App\Contracts\Dao\WishlistDaoInterface;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistDao implements WishlistDaoInterface
{
    /**
     * Get Wishlist list
     * 
     * @return object
     */
    public function getWishlists(): object
    {

        return Wishlist::with('product')
            ->where('wishlists.user_id', Auth::user()->id)
            ->paginate(10)
            ->appends(request()->all());
    }

    /**
     * Save Wishlist
     * @param array
     * @return void
     */
    public function createWishlist(array $data): void
    {
        Wishlist::create($data);
    }

    /**
     * Delete Wishlist by id
     * 
     * @param integer $id
     * @return void
     */
    public function deleteWishlistById(int $id): void
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
    }

    /**
     * Delete wishlist by product id and user id
     *
     * @param integer $id
     * @return void
     */
    public function deleteWishlistByProductId(int $productId): void
    {
        $wishlist = Wishlist::where('product_id', $productId)->where('user_id', Auth::user()->id)->first();
        $wishlist->delete();
    }

    /**
     * Check wishlist
     *
     * @param integer $userId
     * @param integer $productId
     * @return boolean
     */
    public function checkWishlist(int $userId, int $productId): bool
    {
        return Wishlist::where('user_id', $userId)->where('product_id', $productId)->exists();
    }
}
