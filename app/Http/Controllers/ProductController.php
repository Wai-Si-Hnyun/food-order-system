<?php

namespace App\Http\Controllers;
use App\Contracts\Services\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\ReviewServiceInterface;
use App\Models\Review;

class ProductController extends Controller
{
    private $authServiceInterface;
    private $reviewServiceInterface;

    /**
     * Create a new controller instance.
     * @param AuthServiceInterface $userServiceInterface
     * @return void
     */

    public function __construct(AuthServiceInterface $authServiceInterface,ReviewServiceInterface $reviewServiceInterface)
    {
        $this->authService = $authServiceInterface;
        $this->reviewService = $reviewServiceInterface;
    }

    public function list($id)
    {
        $review = $this->reviewService->reviewShow($id);
        $user = $this->authService->getNameById($id);
        return view('user.product.list',compact('review'), [
            'user' => $user
        ]);
    }

    public function review(Request $request)
    {
        $review =$this->reviewService->createReview($request->only([
            'userId','productId','content',
        ]));
        return redirect()->back();
    }

    public function reviewUpdate (Request $request,$id)
    {
        $reviewUpdate = $this->reviewService->updateReview($request->only([
            'comment',
        ]),$id);
          return response()->json(['msg'=>'success'],200);
    }

    public function reviewEdit ($id) {
        $reviewEdit = $this->reviewService->getReviewById($id);
        return response()->json($reviewEdit,200);
    }

    public function reviewDelete($id) {
        $reviewDelete = Review::findOrFail($id);
        $reviewDelete->delete();
        return response()->json(['deletedReview' => $reviewDelete,'msg'=>'success'],200);
    }
}
