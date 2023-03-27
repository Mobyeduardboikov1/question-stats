## Laravel based question-stat API

# Installation steps:

- Run `docker run --rm --interactive --tty -v $(pwd):/app composer install`
- Launch docker instances with `sail up -d` in a detached mode
- Setup database - `sail php artisan migrate:fresh`
- Fill test data: 
- - Run `sail php artisan db:seed --class QuestionSeeder` 
- - Run `sail php artisan db:seed --class AnswerSeeder`


## GET /questions - the API endpoint to show the question list
