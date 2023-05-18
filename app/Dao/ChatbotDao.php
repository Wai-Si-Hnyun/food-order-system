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
        return Chatbot::all();
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
}