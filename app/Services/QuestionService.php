<?php

namespace App\Services;

use App\Contracts\QuestionRepositoryContract;
use App\Contracts\QuestionServiceContract;

class QuestionService implements QuestionServiceContract
{
    protected $questionRepository;

    public function __construct(QuestionRepositoryContract $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function getQuestions()
    {
        return $this->questionRepository->getQuestions();
    }

    public function submitAnswers($answers)
    {
        $this->questionRepository->submitAnswers($answers);
    }
}
