<?php

namespace App\Services;

use App\Contracts\AnswerRepositoryContract;
use App\Contracts\QuestionRepositoryContract;
use App\Contracts\QuestionServiceContract;

/**
 * Business logic abstraction layer to remove heavy-lifting from controllers
 */
class QuestionService implements QuestionServiceContract
{
    protected $questionRepository;
    protected $answerRepository;

    public function __construct(QuestionRepositoryContract $questionRepository, AnswerRepositoryContract $answerRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
    }

    public function getQuestions()
    {
        return $this->questionRepository->getQuestions();
    }

    public function submitAnswers($answers)
    {
        return $this->answerRepository->saveAnswers($answers);
    }
}
