<?php

namespace App\Services;
use App\Contracts\Dao\ChatbotDaoInterface;
use App\Contracts\Services\ChatbotServiceInterface;

class ChatbotService implements ChatbotServiceInterface
{
    private $chatbotDao;

    public function __construct(ChatbotDaoInterface $chatbotDao)
    {
        $this->chatbotDao = $chatbotDao;
    }

    /**
     * Get all data from chatbot table
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->chatbotDao->getAll();
    }

    /**
     * Get question and answer by id
     *
     * @param integer $id
     * @return \App\Models\Chatbot
     */
    public function getQAById(int $id)
    {
        return $this->chatbotDao->getQAById($id);
    }

    /**
     * Get all questions from  database
     *
     * @return \App\Models\Chatbot
     */
    public function getAllQuestions()
    {
        return $this->chatbotDao->getAllQuestions();
    }

    /**
     * Get answer for specific question
     *
     * @param string $question
     * @return string $answer
     */
    public function getAnswer(string $question)
    {
        return $this->chatbotDao->getAnswer($question);
    }

    /**
     * Store question and answer
     *
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $this->chatbotDao->store($data);
    }

    /**
     * Update data
     *
     * @param array $data
     * @param integer $id
     * @return void
     */
    public function update(array $data, int $id)
    {
        $this->chatbotDao->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $this->chatbotDao->delete($id);
    }
}