<?php
namespace App\Dao;

use App\Contracts\Dao\FeedbackDaoInterface;
use App\Models\Feedback;

class FeedbackDao implements FeedbackDaoInterface
{
    public function getAllFeedback():object
    {
        return Feedback::all();
    }

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
        return Feedback::orderBy('created_at', 'asc')->paginate(5);
    }

    public function searchfeedback():object
    {
        $search_name = request()->query('query');
        $students = Feedback::where('name','LIKE','%'.$search_name.'%')
        ->orwhere('email','LIKE','%'.$search_name.'%')
        ->latest()
        ->paginate(5);

        $students->appends(['query' => $search_name]);

        return $students;
    }

    public function getFeedbackById(int $id): object
    {
        return Feedback::findOrFail($id);
    }
}
