<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\QuestionOption;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

        // Create text answer question
        $textQuestion = [
            'title' => 'Can you decipher me?',
        ];

        // Create multiple choice questions
        for ($i = 0; $i < 8; $i++) {
            $question = Question::create([
                'question_text' => "Q$i",
                'type' => 'mcq',
            ]);

            foreach ([0,1,2,3,4,5] as $optionText) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option' => $optionText,
                ]);
            }
        }

        // Create text answer question
        $textQuestion = Question::create([
            'question_text' => $textQuestion['title'],
            'type' => 'text',
        ]);
    }
}
