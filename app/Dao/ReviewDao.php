<?php
namespace App\Dao;

use App\Contracts\Dao\ReviewDaoInterface;
use App\Models\Review;

class ReviewDao implements ReviewDaoInterface
{
    public function createReview(array $data): void
    {
        Review::create([
            'user_id'=>$data['userId'],
            'product_id'=>$data['productId'],
            'comment' => $data['content']
        ]);
    }

    public function reviewShow(int $id):object {
        return Review::where('user_id',$id)->orderBy('created_at', 'asc')->get();
    }



    public function updateReview(array $data, $id): void
    {
        $reviews = Review::findOrFail($id);
        $reviews->update([
            'comment'=>$data['comment'],
        ]);
    }

    public function getReviewById(int $id): object
    {
        return Review::findOrFail($id);
    }

    //admin review list
    public function getReview(): object
    {
        return Review::select('reviews.*','users.name as user','products.name as product')
        ->join('users','reviews.user_id','users.id')
        ->join('products','reviews.product_id','products.id')
        ->get();
    }
}
