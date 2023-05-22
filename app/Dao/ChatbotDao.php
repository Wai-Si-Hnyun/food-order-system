<?php

namespace App\Dao;
use App\Contracts\Dao\ChatbotDaoInterface;
use App\Models\Chatbot;

/**
 * Get all questions from chatbot table
 * 
 * @return \App\Models\Chatbot
 */
class ChatbotDao implements ChatbotDaoInterface
{
    /**
     * Get all data from chatbot table
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Chatbot::when(request('key'), function($query) {
            $query->where('question', 'LIKE', '%'.request('key').'%');
        })
        ->orderBy('created_at', 'desc')
        ->get();
    }

    /**
     * Get question and answer data by id
     *
     * @param integer $id
     * @return \App\Models\Chatbot
     */
    public function getQAById(int $id)
    {
        return Chatbot::where('id', $id)->first();
    }

    /**
     * Update data in chatbot table
     *
     * @param array $data
     * @param integer $id
     * @return void
     */
    public function update(array $data, int $id)
    {
        $chatbot = Chatbot::findOrFail($id);
        $chatbot->update($data);
    }

    /**
     * Get all questions from chatbot table
     *
     * @return \App\Models\Chatbot
     */
    public function getAllQuestions()
    {
        return Chatbot::pluck('question');
    }

    /**
     * Get answer for specific question
     *
     * @param string $question
     * @return string
     */
    public function getAnswer(string $question)
    {
        return Chatbot::where('question', $question)->first()->answer;
    }

    /**
     * Store question and answer in database
     *
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        Chatbot::create($data);
    }

    /**
     * Delete data from database
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $chatbot = Chatbot::findOrFail($id);
        $chatbot->delete();
    }
}