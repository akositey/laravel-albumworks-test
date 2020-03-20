## Laravel AlbumWorks Test
> this sample project is using Laravel 7 with sample PHPUnit test.Make sure you have PHP >= 7.2.5 installed. For reference please see [Laravel installation](https://laravel.com/docs/7.x/installation)

### Tests Location
- all tests are inside the `tests/` folder

### Answers 
- Answer to Q1 is in `Feature/AlphabetTest.php`
- Answer to Q2 is `Unit/RewardLevelTest.php`

### Running Tests (PHPUnit)
- after cloning or downloading, run `composer install` inside the project's root directory
- if you have previously ran `php artisan config:cache` , please run `php artisan config:clear` before running tests
- run all tests using `php artisan test` or `vendor/bin/phpunit` or if you have phpunit installed globally, just run `phpunit`
- to run tests individually, run do something like `php artisan test [path-to-file]`. Ex: to test AlphabetTest run `php artisan test tests/Feature/AlphabetTest`
