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

## API Documentation
### User Routes
#### Register
- Route: POST /api/register
- Description: This endpoint is used to register new users into the system.
- Headers:

    - Content-Type: application/json
    - Accept: application/json
- Example of JSON request:
    ```json
        {
           "name": "{name}",
           "email": "{email}",
           "password": "{password}",
           "password_confirmation": "{password_confirmation}" 
        }
- Example of JSON response:
    ```json
        {
            "error": false,
            "message": "User Created"
        }
#### Login
- Route: POST /api/login
- Description: This endpoint is used to perform the user login process into the system.
- Headers:

    - Content-Type: application/json
    - Accept: application/json
- Example of JSON request:
    ```json
        {
           "email": "{email}",
           "password": "{password}",
        }
- Example of JSON response:
    ```json
        {
            "error": false,
            "message": "success",
            "loginResult": {
                "id": "{id}",
                "name": "{name}",
                "email": "{email}",
                "email_verified_at": null,
                "token": "{token}"
            }
        }
#### Get User's Data
- Route: GET /api/me
- Description: This endpoint is used to get user's data such as name and email.
- Headers:

    - Authorization: Bearer {token}
    - Content-Type: application/json
    - Accept: application/json
- Example of JSON response:
    ```json
        {
            "error": false,
            "message": "success",
            "id": "{id}",
            "name": "{name}",
            "email": "{email}",
            "email_verified_at": null
        }
#### Send Email Verification
- Route: POST /api/email-verification
- Description: This endpoint is used to send verification email to users.
- Headers:

    - Content-Type: application/json
    - Accept: application/json
- Example of JSON request:
    ```json
        {
           "email": "{email}",
        }
- Example of JSON response:
    ```json
        {
            "error": false,
            "message": "OTP code has been sent to email"
        }
#### Verify Email
- Route: POST /api/verify-email
- Description: This endpoint is used to verify the user's email.
- Headers:

    - Content-Type: application/json
    - Accept: application/json
- Example of JSON request:
    ```json
        {
           "email": "{email}",
           "otp": "{otp}"
        }
- Example of JSON response:
    ```json
        {
            "error": false,
            "message": "Email verified successfully"
        }
#### Logout
- Route: POST /api/logout
- Description: This endpoint is used to log out users from the system.
- Headers:

    - Authorization: Bearer {token}
    - Content-Type: application/json
    - Accept: application/json
- Example of JSON response:
    ```json
        {
            "error": false,
            "message": "User Logged Out"
        }
#### Send Email Forgot Password
- Route: POST /api/forgot-password
- Description: This endpoint is used to send forgot password emails to users.
- Headers:

    - Content-Type: application/json
    - Accept: application/json
- Example of JSON request:
    ```json
        {
           "email": "{email}",
        }
- Example of JSON response:
    ```json
        {
            "error": false,
            "message": "OTP code has been sent to email"
        }
#### Verify OTP Forgot Password
- Route: POST /api/verify-otp
- Description: This endpoint is used to check the validity of the OTP code for reset password.
- Headers:

    - Content-Type: application/json
    - Accept: application/json
- Example of JSON request:
    ```json
        {
           "email": "{email}",
           "otp": "{otp}"
        }
- Example of JSON response:
    ```json
        {
            "error": false,
            "message": "OTP verified successfully"
        }
#### Reset Password
- Route: POST /api/reset-password
- Description: This endpoint is used to reset the password after the otp has been verified.
- Headers:

    - Content-Type: application/json
    - Accept: application/json
- Example of JSON request:
    ```json
        {
            "email": "{email}",
            "new_password": "{new_password}",
            "new_password_confirmation": "{new_password}"
        }
- Example of JSON response:
    ```json
        {
            "error": false,
            "message": "Password reset successfully"
        }
#### Update Profile
- Route: PUT /api/update-profile
- Description: This endpoint is used to update user profiles such as name and email.
- Headers:

    - Authorization: Bearer {token}
    - Content-Type: application/json
    - Accept: application/json
- Example of JSON request:
    ```json
        {
           "name": "{name}",
           "email": "{email}",
        }
- Example of JSON response:
    ```json
        {
            "error": false,
            "message": "Profile updated successfully"
        }
#### Change Password
- Route: PUT /api/change-password
- Description: This endpoint is used to change the user's password.

    - Authorization: Bearer {token}
    - Content-Type: application/json
    - Accept: application/json
- Example of JSON request:
    ```json
        {
            "current_password": "{current_password}",
            "new_password": "{new_password}",
            "new_password_confirmation": "{new_password_confirmation}"
        }
- Example of JSON response:
    ```json
        {
            "error": false,
            "message": "Password changed successfully"
        }
### Article Routes
#### Get All Articles
- Route: GET /api/articles
- Description: This endpoint is used to get all existing articles.
- Headers:

    - Content-Type: application/json
    - Accept: application/json
- Example of JSON response:
    ```json
        {
            "error": false,
            "message": "Articles fetched successfully",
            "listArticle": [
                {
                    "id": "{id}",
                    "title": "{title}",
                    "slug": "{slug}",
                    "news_writer": "{news_writer}",
                    "source": "{source}}",
                    "source_date": "{source_date}}",
                    "description": "{description}",
                    "thumbnail": "{thumbnail}",
                    "content": "{content}",
                    "created_at": "{created_at}",
                    "updated_at": "{updated_at}"
                }
            ]
        }
#### Get Detail Article
- Route: GET /api/articles/{slug}/show
- Description: This endpoint is used to get detail of one of the of one of the article.
- Headers:

    - Content-Type: application/json
    - Accept: application/json
- Example of JSON response:
    ```json
        {
            "error": false,
            "message": "Show article successfully",
            "showArticle": {
                "id": "{id}",
                "title": "{title}",
                "slug": "{slug}",
                "news_writer": "{news_writer}",
                "source": "{source}}",
                "source_date": "{source_date}}",
                "description": "{description}",
                "thumbnail": "{thumbnail}",
                "content": "{content}",
                "created_at": "{created_at}",
                "updated_at": "{updated_at}"
            }
        }
### Prediction Routes
#### Predict a Job Vacancy
- Route: POST /api/predict
- Description: This endpoint is used to predict the authenticity of job vacancies.
- Headers:

    - Authorization: Bearer {token}
    - Content-Type: application/json
    - Accept: application/json
- Example of JSON request:
    ```json
        {
            "title": "Mobile Developer",
            "location": "Jakarta, Indonesia",
            "department": "Information Technology",
            "salary_range": "80000-100000",
            "company_profile": "Carval is a startup company...",
            "description": "We need a mobile developer with experience...",
            "requirements": "Have 3 years of experience...",
            "benefits": "Great salary, flexible working hours....",
            "telecommuting": 0
        }
- Example of JSON response:
    ```json
        {
          "error": false,
          "message": "Data predicted successfully",
          "predictionResult": {
              "fake_probability": 79.2,
              "prediction": "Fake",
              "real_probability": 20.8
          }
        }
### Newsletter Routes
#### Send Newsletter
- Route: POST /api/newsletter
- Description: This endpoint is used to send a newsletter.
- Headers:

    - Content-Type: application/json
    - Accept: application/json
- Example of JSON request:
    ```json
        {
            "message": "{message}",
        }
- Example of JSON response:
    ```json
        {
          "error": false,
          "message": "Newsletter sent successfully",
        }  