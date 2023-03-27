<?php

namespace App\Providers;

use App\Contracts\AnswerRepositoryContract;
use Illuminate\Support\ServiceProvider;
use App\Contracts\QuestionRepositoryContract;
use App\Contracts\QuestionServiceContract;
use App\Repositories\AnswerRepository;
use App\Repositories\QuestionRepository;
use App\Services\QuestionService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(QuestionServiceContract::class, QuestionService::class);
        $this->app->bind(QuestionRepositoryContract::class, QuestionRepository::class);
        $this->app->bind(AnswerRepositoryContract::class, AnswerRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
