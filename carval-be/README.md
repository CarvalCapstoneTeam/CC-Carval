# CARVAL Backend

Backend of CARVAL App built with [Laravel 10](https://laravel.com/docs/10.x).

## Requirements
1. Install web server like Apache or Nginx
2. Install php 8.1 - 8.2
3. Install composer
4. Install MySQL

## How to run

Clone the repository

    https://github.com/CarvalCapstoneTeam/CC-Carval.git

Switch to the repo folder

    cd CC-Carval/carval-be

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new JWT authentication secret key

    php artisan jwt:secret

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Create symbolic link

    php artisan storage:link

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000