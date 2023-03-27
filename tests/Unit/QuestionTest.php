<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Services\QuestionService;
use App\Repositories\AnswerRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    public function testTextQuestionSubmission()
    {
        $question = Question::factory()->create(['type' => 'text']);
        $questionService = new QuestionService(new QuestionRepository(), new AnswerRepository());

        $answer = [
            'question_id' => $question->id,
            'answer_text' => 'This is a sample text answer'
        ];

        $response = $questionService->submitAnswers([$answer]);

        $this->assertEquals(1, $response->count());
        $this->assertInstanceOf(Answer::class, $response->first());
        $this->assertEquals($answer['question_id'], $response->first()->question_id);
        $this->assertEquals($answer['answer_text'], $response->first()->answer_text);
    }


    public function testMCQQuestionSubmission()
    {
        $question = Question::factory()->create(['type' => 'mcq']);
        $questionService = new QuestionService(new QuestionRepository(), new AnswerRepository());

        $option = QuestionOption::factory()->create([
            'question_id' => $question->id,
            'option' => 'Option A'
        ]);

        $answer = [
            'question_id' => $question->id,
            'option_id' => $option->id,
        ];

        $response = $questionService->submitAnswers([$answer]);
        $this->assertEquals(1, $response->count());
}


    public function testGetQuestions()
    {
        Question::factory(5)->create();
        $questionService = new QuestionService(new QuestionRepository(), new AnswerRepository(Answer::class));

        $questions = $questionService->getQuestions();

        $this->assertCount(5, $questions);
    }
}
