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
     * Go to detail page
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        $qaData = $this->chatbotService->getQAById($id);

        return view('admin.pages.q&a.detail', compact('qaData'));
    }

    /**
     * Go to edit page
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $qa = $this->chatbotService->getQAById($id);

        return view('admin.pages.q&a.edit', compact('qa'));
    }

    public function update(QuestionAnswerRequest $request, int $id)
    {
        $this->chatbotService->update($request->all(), $id);

        return redirect()->route('q&a.index')->with('success', 'Question and answer successfully updated!');
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

    /**
     * Delete data from table
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete (int $id)
    {
        $this->chatbotService->delete($id);

        return response()->json(['success' => 'Question and answer successfully deleted'], 200);
    }
}
