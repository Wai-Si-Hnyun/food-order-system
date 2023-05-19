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
}