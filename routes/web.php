<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/questions', [QuestionController::class, 'getQuestions']);
Route::post('/submit-answers', [QuestionController::class, 'submitAnswers']);
