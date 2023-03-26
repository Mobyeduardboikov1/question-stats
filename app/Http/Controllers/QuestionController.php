<?php

namespace App\Http\Controllers;

use App\Contracts\QuestionServiceContract;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $questionService;

    public function __construct(QuestionServiceContract $questionService)
    {
        $this->questionService = $questionService;
    }

    public function getQuestions()
    {
        $questions = $this->questionService->getQuestions();
        return response()->json($questions);
    }

    public function submitAnswers(Request $request)
    {
        $answers = $request->get('answers');
        $this->questionService->submitAnswers($answers);
        return response()->json(['status' => 'success']);
    }
}
