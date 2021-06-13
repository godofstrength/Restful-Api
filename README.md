simple restful api authentication using laravel passport.
download the project, create a database and connect
install passport using the command:
composer require laravel/passport
run the migrations using this command:
php artisan migrate
Next, we need to create encryption keys. These keys are needed for generating the access token. Install the keys with this command:
php artisan passport:install
use postman or any api test of your choice, 
you're all set
