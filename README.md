## Laravel based question-stat API

# Installation steps:

- Run `composer install`
- Launch docker instances with `docker-compose up`
- Setup database - `sail php artisan migrate:fresh`
- Fill test data: 
- - Run `sail php artisan db:seed --class QuestionSeeder` 
- - Run `sail php artisan db:seed --class AnswerSeeder`


## GET /questions - the API endpoint to show the question list
