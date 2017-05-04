* Add 
`\Kingzmedia\Comments\CommentsServiceProvider::class,` to config/app.php


Run 
````bash
php artisan vendor:publish --provider="Kingzmedia\Comments\CommentsServiceProvider" --tag=migrations
php artisan migrate
````


Run 
````bash
php artisan vendor:publish --provider="Kingzmedia\Comments\CommentsServiceProvider" --tag=config
````