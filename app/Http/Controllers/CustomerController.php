<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ChatbotServiceInterface;
use Illuminate\Http\Request;

class customerController extends Controller
{
    private $chatbotService;

    public function __construct(ChatbotServiceInterface $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }
    public function care() {
        $questions = $this->chatbotService->getAllQuestions();

        return view("user.main.help", compact('questions'));
    }
}
