<?php

namespace App\Contracts;

interface QuestionRepositoryContract
{
    public function getQuestions();
    public function submitAnswers($answers);
}
