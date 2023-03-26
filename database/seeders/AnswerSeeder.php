<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Answer;

class AnswerSeeder extends Seeder {
    public function run() {
        
        // Get all questions from the database
        $questions = Question::with('options')->get();

        // Loop through the questions and generate 100K random answers per question
        foreach ($questions as $question) {

            $answers = [];

            $options = $question->options->pluck('id')->toArray();

            for ($i = 0; $i < 100000; $i++) {
                // No need to use Eloquent here to stay more memory-efficient.
                $answer = [
                    'question_id' => $question->id,
                ];
                if ($question->type === 'mcq') {
                    $answer['option_id'] = $options[array_rand($options)];
                } else {
                    $answer['answer_text'] = $this->generateTextAnswer();
                }


                $answers[] = $answer;
            }

            $chunks = array_chunk($answers, 1000);
            foreach ($chunks as $chunk) {
                Answer::insert($chunk);
            }
        }
    }

    public function generateTextAnswer() {
        $words = ['lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit'];
        $randomWords = array_rand($words, rand(3, 8));
        $answer = '';
        foreach ($randomWords as $index) {
            $answer .= $words[$index] . ' ';
        }
        $answer = rtrim($answer);
        $answer .= '.';

        return ucfirst($answer);
    }
}
