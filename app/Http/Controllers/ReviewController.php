<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\ReviewServiceInterface;
use App\Models\Review;
use App\Models\User;

class ReviewController extends Controller
{
    private $reviewServiceInterface;

    /**
     * Create a new controller instance.
     * @param AuthServiceInterface $userServiceInterface
     * @return void
     */

    public function __construct(ReviewServiceInterface $reviewServiceInterface)
    {
        $this->reviewService = $reviewServiceInterface;
    }
    public function reviewList() {
        $review = $this->reviewService->getReview();
        return view('admin.review.list', [
            'review' => $review
        ]);
    }

    public function reviewDestory($id) {
        $reviewDelete = Review::findOrFail($id);
        $reviewDelete->delete();
        return response()->json(['deletedReview' => $reviewDelete,'msg'=>'success'],200);
    }
}
