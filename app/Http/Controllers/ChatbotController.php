<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ChatbotServiceInterface;
use App\Http\Requests\QuestionAnswerRequest;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    private $chatbotService;

    public function __construct(ChatbotServiceInterface $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }

    /**
     * Go to index page of questions and answers
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $qaData = $this->chatbotService->getAll();

        return view('admin.pages.q&a.index', compact('qaData'));
    }

    /**
     * Go to create page of questions and answers
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.pages.q&a.create');
    }

    public function store(QuestionAnswerRequest $request)
    {
        $this->chatbotService->store($request->all());

        return redirect()->route('q&a.index')->with('success', 'Question and answer successfully created!');
    }

    /**
     * Get answer for specific question
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAnswer(Request $request)
    {
        $question = $request->question;

        $answer = $this->chatbotService->getAnswer($question);

        return response()->json($answer, 200);
    }
}
