<?php

namespace App\Http\Controllers;
use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use App\Contracts\Services\FeedbackServiceInterface;

class FeedbackController extends Controller
{
    private $feedbackService;

    /**
     * Create a new controller instance.
     * @param \App\Contracts\Services\FeedbackServiceInterface $userServiceInterface
     * @return void
     */

    public function __construct(FeedbackServiceInterface $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }


    /**
     * function feedback page
     */
    public function feedback() {
        return view('user.main.feedback');
    }

    /**
     * function feedback create
     */

    public function feedbackCreate(FeedbackRequest $request) {
        $this->feedbackService->createFeedback($request->only([
            'name','email','message',
        ]));

        return response()->json(['msg' => 'success'], 200);
    }

    /**
     * function feedback list
     */
    public function feedbackList() {
        $message = $this->feedbackService->getMessage();
        return view('admin.pages.feedback.index', [
            'message' => $message
        ]);
    }

    /**
     * function feedback destory
     */
    public function feedbackDestory($id) {
        $reviewFeedback = $this->feedbackService->getFeedbackById($id);
        $reviewFeedback->delete();
        return response()->json(['reviewFeedback' => $reviewFeedback,'msg'=>'success'],200);
    }


    /**
     * function feedback search
     */
    public function feedbackSearch() {
        $message=$this->feedbackService->searchfeedback();
        return view('admin.pages.feedback.index', [
            'message' => $message
        ]);

    }

    public function show(Feedback $feedback)
    {
        return view('admin.pages.feedback.detail', compact('feedback'));
    }
}
