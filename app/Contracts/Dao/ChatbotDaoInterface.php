<?php

namespace App\Contracts\Dao;

interface ChatbotDaoInterface
{
    /**
     * Get all data from chatbot table
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Get all questions
     *
     * @return \App\Models\Chatbot
     */
    public function getAllQuestions();

    /**
     * Get answer for specific question
     *
     * @param string $question
     * @return string $answer
     */
    public function getAnswer(string $question);

    /**
     * Store question and answer
     *
     * @param array $data
     * @return void
     */
    public function store(array $data);
}