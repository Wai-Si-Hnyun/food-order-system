<?php
namespace App\Dao;

use App\Contracts\Dao\FeedbackDaoInterface;
use App\Models\Feedback;

class feedbackDao implements FeedbackDaoInterface
{
    public function createFeedback(array $data):void
    {
        Feedback::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'message' => $data['message']
        ]);
    }

    public function getMessage():object
    {
        return Feedback::orderBy('created_at', 'asc')->get();
    }

}