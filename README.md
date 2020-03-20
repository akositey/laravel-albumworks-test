## Laravel AlbumWorks Test
> this sample project is using Laravel 7 with sample PHPUnit test.

### Requirements
This is a raw Laravel 7 project so you should have PHP >= 7.2.5 installed. For reference please see [Laravel installation](https://laravel.com/docs/7.x/installation)

### Tests Location
- all tests are inside the `tests/` folder

### Answers 
- Answer to Q1 is in `Feature/AlphabetTest.php`
- Answer to Q2 is `Unit/RewardLevelTest.php`

### Running Tests (PHPUnit)
1. after cloning or downloading, run `composer install` inside the project's root directory using your terminal/shell
2. 
   - on Linux/Mac: `cp .env.example .env`
   - on Windows: `copy .env.example .env`

3. run `php artisan key:generate`
4. (optional) if you have accidentally or intentionally ran `php artisan config:cache`, please run `php artisan config:clear` before running tests as per [Laravel documentation](https://laravel.com/docs/7.x/testing#environment)
5. run all tests by running:
   - `php artisan test` 
   - or `vendor/bin/phpunit` 
   - or if you have phpunit installed globally, just run`phpunit`
6. to run tests individually, run do something like: 
   - `php artisan test [path-to-file]`. 
   - Ex: to test AlphabetTest run `php artisan test tests/Feature/AlphabetTest`
