<?php

namespace App\Contracts;

interface QuestionServiceContract
{
    public function getQuestions();
    public function submitAnswers($answers);
}
