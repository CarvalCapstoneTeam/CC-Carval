# CC-Carval

The capstone project is carried out by the cloud computing team in collaboration with the CH2-PS525 team. It involves the development of Landing Page, Admin Page, RESTful API using [Laravel 10](https://laravel.com/docs/10.x), which is deployed using [Google Compute Engine](https://cloud.google.com/compute). In addition, there is a RESTful API built with [Flask](https://flask.palletsprojects.com/en/3.0.x/) for making predictions using a Machine Learning model in branch [prediction](https://github.com/CarvalCapstoneTeam/CC-Carval/tree/prediction), deployed using [Google Cloud Run](https://cloud.google.com/run).

You can see the results that have been deployed in:
- Landing page: https://carval.cloud
- API Documentation: https://carval.cloud/docs
 
## Requirements
1. Install web server like Apache or Nginx
2. Install php 8.1 - 8.2
3. Install MySQL
4. Install composer

## How to run
- Clone the repository
 
        git clone https://github.com/CarvalCapstoneTeam/CC-Carval.git

- Switch to the repo folder

        cd CC-Carval
        
- Install all the dependencies using composer
        
        composer install

- Copy the example env file and make the required configuration changes in the .env file

        cp .env.example .env
        
- Generate a new application

        php artisan key:generate
        
- Generate a new JWT authentication secret key

        php artisan jwt:secret
        
- Run the database migrations (**Set the database connection in .env before migrating**)

        php artisan migrate

- Create symbolic link

        php artisan storage:link
        
- Generate api documentation with [Scribe](https://scribe.knuckles.wtf/)

        php artisan scribe:generate

- Start the local development

        php artisan serve

- The server is currently running at http://localhost:8000. You can now view the landing page at http://localhost:8000, access the API documentation at http://localhost:8000/docs, and log in to the admin page at http://localhost:8000/login.