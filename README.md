composer install
run mysql with xampp
create 2 database: levo and levo-test
php artisan migrate
php artisan db:seed
php artisan --env=testing migrate
php artisan schedule:work
php artisan queue:work

To send email is necesary use mailtrap.io and select laravel configuration

create .env later and add QUEUE_CONNECTION=database
create .env-testing and add APP_ENV=testing

Add in config/database.php

 'mysql_test' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('TESTING_DB_HOST', '127.0.0.1'),
            'port' => env('TESTING_DB_PORT', '3306'),
            'database' => env('TESTING_DB_DATABASE', 'forge'),
            'username' => env('TESTING_DB_USERNAME', 'forge'),
            'password' => env('TESTING_DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],


Finally, run the test:

php artisan test.
