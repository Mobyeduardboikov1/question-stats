<?php

namespace App\Repositories;

use App\Models\Answer;
use App\Contracts\AnswerRepositoryContract;

class AnswerRepository implements AnswerRepositoryContract
{
    protected $answer;

    public function saveAnswers(array $answers)
    {
        $createdAnswers = collect($answers)->map(function ($answer) {
            return Answer::create([
                'question_id' => $answer['question_id'],
                'option_id' => $answer['option_id'] ?? null,
                'answer_text' => $answer['answer_text'] ?? null,
            ]);
        });

        return $createdAnswers;
    }

}
