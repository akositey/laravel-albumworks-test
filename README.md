# Laravel AlbumWorks Test
a sample project is using Laravel 7 with PHPUnit tests.

## Requirements
Since this project is in Laravel 7, we should meet its server requirements:
- PHP >= 7.2.5 installed. Maybe other php extensions as well. Please see: [Laravel installation](https://laravel.com/docs/7.x/installation)
- `composer` installed. Please see: [Composer installation](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)

## Tests Location
- all tests are inside the `tests/` folder

## Answers 
- Answer to Q1 is in `Feature/AlphabetTest.php`
- Answer to Q2 is `Unit/RewardLevelTest.php`

## Running Tests (PHPUnit)
1. after cloning or downloading, run `composer install` inside the project's root directory using your terminal/shell
2. to be able to run step 3, we should have a .env file:
   - on Linux/Mac: `cp .env.example .env`
   - on Windows: `copy .env.example .env`
3. run `php artisan key:generate` to generate APP_KEY in the .env file. 
   > For the purpose of running tests alone, we don't need mysql. The phpunit.xml file is configured to use sqlite as the database connection.
4. (optional) if you have accidentally or intentionally ran `php artisan config:cache`, please run `php artisan config:clear` before running tests as per [Laravel documentation](https://laravel.com/docs/7.x/testing#environment)
5. run all tests by running:
   - `php artisan test` 
   - or `vendor/bin/phpunit` 
   - or if you have phpunit installed globally, just run `phpunit`
6. to run tests individually, run do something like: 
   - `php artisan test [path-to-file]`. 
   - Ex: `php artisan test tests/Feature/AlphabetTest`
