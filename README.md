# Tinify
A **Laravel** based URL shortner app. 

## Usage

- Install dependencies (PHP)

    `composer install`
    
-  Generate App Key

    `php artisan key:generate`

- Set the database configurations in the `.env` file.
- Run migrations

	`php artisan migrate`
- Run app

	`php artisan serve`
- Now you can access your app on `http://localhost:8000 or 8080`

## Tech stack

 - Laravel (6.0) 
 -  PostgreSQL
 - [Bootswatch](https://bootswatch.com/) (Free Bootstrap themes)
 - [Jenssegers\Agent\Agent](https://github.com/jenssegers/agent) (A PHP desktop/mobile user agent parser)
- [Heroku](http://heroku.com) cloud hosting (With automatic deploys from this repo)
