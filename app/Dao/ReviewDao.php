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

    public function updateReview(array $data,$id): void
    {
        $reviews = Review::where('user_id',$id);
        $reviews->update([
            'comment'=>$data['content'],
        ]);
    }

    public function reviewShow(int $id):object {
        return Review::select('reviews.*','users.name as user','products.name as product')
        ->join('users','reviews.user_id','users.id')
        ->join('products','reviews.product_id','products.id')
        ->where('product_id',$id)
        ->latest()
        ->paginate(5);
    }

    //admin review list
    public function getReview(): object
    {
        return Review::select('reviews.*','users.name as user','products.name as product')
        ->join('users','reviews.user_id','users.id')
        ->join('products','reviews.product_id','products.id')
        ->latest()
        ->paginate(3);
    }

    public function searchReview():object
    {
        $search_name = request()->query('query');
        $students = Review::select('reviews.*','users.name as user','products.name as product')
        ->join('users','reviews.user_id','users.id')
        ->join('products','reviews.product_id','products.id')
        ->where('users.name','LIKE','%'.$search_name.'%')
        ->orwhere('products.name','LIKE','%'.$search_name.'%')
        ->latest()
        ->paginate(5);

        $students->appends(['query' => $search_name]);

        return $students;
    }

    public function getReviewById(int $id): object
    {
        return Review::findOrFail($id);
    }
}
