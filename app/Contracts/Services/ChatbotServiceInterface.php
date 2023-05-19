<?php

namespace App\Contracts\Services;

interface ChatbotServiceInterface
{
    /**
     * Get all data from chatbot table
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Get question and answer by id
     *
     * @param integer $id
     * @return \App\Models\Chatbot
     */
    public function getQAById(int $id);

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

    /**
     * Update data
     *
     * @param array $data
     * @param integer $id
     * @return void
     */
    public function update(array $data, int $id);

    /**
     * Delete data
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id);
}