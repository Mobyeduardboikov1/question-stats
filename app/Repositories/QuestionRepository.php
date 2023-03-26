<?php

namespace App\Repositories;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use App\Contracts\QuestionRepositoryContract;

class QuestionRepository implements QuestionRepositoryContract
{

    public function getQuestions()
    {
        DB::enableQueryLog();
        $questions = Question::with('options')->get();
    
        $result = [];
    
        foreach ($questions as $question) {
            if ($question->type !== 'mcq') {

                // Get answer count to the text question
                $answersCount = DB::table('answers')
                    ->where('question_id', $question->id)
                    ->count();
    
                /**
                 * Generate a word cloud:
                 * 1. Get answer_text field (which can be a sentence)
                 * 2. For every sentence return an array of found words
                 * 3. Group by word
                 * 4. Count repetitions of the word
                 * ----
                 * Format: <word>:<count>
                 */
                
                $wordCloud = DB::table('answers')
                    ->where('question_id', $question->id)
                    ->pluck('answer_text')
                    ->flatMap(function ($answer) {
                        return str_word_count($answer, 1);
                    })
                    ->groupBy(function ($word) {
                        return $word;
                    })
                    ->map(function ($grouped) {
                        return count($grouped);
                    });
                    
    
                $result[] = [
                    'id' => $question->id,
                    'type' => $question->type,
                    'question_text' => $question->question_text,
                    'answers_count' => $answersCount,
                    'word_cloud' => $wordCloud,
                ];
            } else {
                $questionOptions = $question->options;
    
                $answersCount = DB::table('answers')
                    ->where('question_id', $question->id)
                    ->count();
    
                $options = [];
    
                foreach ($questionOptions as $option) {
                    $optionCount = DB::table('answers')
                        ->where('option_id', $option->id)
                        ->count();
    
                    $options[] = [
                        'option' => $option->option,
                        'count' => $optionCount,
                    ];
                }
    
                $average = DB::table('answers')
                    ->where('question_id', $question->id)
                    ->avg('option_id');
    
                $result[] = [
                    'id' => $question->id,
                    'type' => $question->type,
                    'question_text' => $question->question_text,
                    'answers_count' => $answersCount,
                    'options' => $options,
                    'average' => $average,
                ];
            }
        }
    
        return $result;
    }
    
    public function submitAnswers($answers)
    {
        $data = [];

        foreach ($answers as $answer) {
            $data[] = [
                'question_id' => $answer['question_id']
            ];
            if ($answer->option_id) {
                $data['option_id'] = $answer['option_id'];
            } else {
                $data['answer_text'] = $answer['answer_text'];

            }
           
        }

        Answer::insert($data);
    }
}
