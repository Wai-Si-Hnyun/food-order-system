<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    public function feedbackCreate(Request $request) {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'email'=>'required|max:255',
            'message'=>'required'
        ]);
        if ($validator->fails()){
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
        $feedback =$this->feedbackService->createFeedback($request->only([
            'name','email','message',
        ]));
        return redirect()->back();


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
        $reviewFeedback = Feedback::findOrFail($id);
        $reviewFeedback->delete();
        return response()->json(['reviewFeedback' => $reviewFeedback,'msg'=>'success'],200);
    }
}
