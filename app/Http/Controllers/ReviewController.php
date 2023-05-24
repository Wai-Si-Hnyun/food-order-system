<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Contracts\Services\ReviewServiceInterface;
use App\Contracts\Services\AuthServiceInterface;
use App\Models\Review;

class ReviewController extends Controller
{
    private $authService;
    private $reviewService;

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
    /**
     * function reviews create
     */
    public function review(Request $request)
    {
        $user = Review::where('user_id',$request->userId)->get();
        if ($user->toArray() == null) {
            $this->reviewService->createReview($request->only([
                'userId','productId','content',
            ]));
            return redirect()->back();
        }
        else {
            $id = $request->userId;
            $this->reviewService->updateReview($request->only([
                'content',
            ]),$id);
            return redirect()->back();
        }
    }

    /**
     * function review update
     */
    public function reviewUpdate (Request $request,$id)
    {
        $this->reviewService->updateReview($request->only([
            'comment',
        ]),$id);
          return response()->json(['msg'=>'success'],200);
    }


    /**
     * function review edit
     */
    public function reviewEdit ($id) {
        $reviewEdit = $this->reviewService->getReviewById($id);
        return response()->json($reviewEdit,200);
    }



    /**
     * function review show(for admin)
     */
    public function reviewList() {
        $review = $this->reviewService->getReview();
        return view('admin.pages.reviews.list', [
            'review' => $review
        ]);
    }

    /**
     * function review delete(for admin)
     */
    public function reviewDestory($id) {
        $reviewDelete =$this->reviewService->deleteReviewById($id);

        return response()->json(['deletedReview' => $reviewDelete,'msg'=>'success'],200);
    }


    /**
     * function review delete(for admin)
     */
    public function reviewSearch() {
        $review=$this->reviewService->searchReview();
        return view('admin.pages.reviews.list', [
            'review' => $review
        ]);
    }

    /**
     * Show review detail page
     *
     * @param \App\Models\Review $review
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Review $review)
    {
        $review = $review->load('user', 'product');

        return view('admin.pages.reviews.detail', compact('review'));
    }
}
