# Tinify
A **Laravel** based URL shortner app. You can create unlimited short URLs. This app also provides insights like clicks by browser, clicks by devices, clicks by OS and IP address tracking.

The demo is available [here](https://tini-fy.herokuapp.com/). 
You can use below credentials to see the dashboard or can create your own your on the register page

> **Email**  - ishaan@example.com
>
> **Password** - zzzzzzzz

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

## Screenshots

#### Home screen
![homescreen](https://github.com/sheikh005/LinkShortner/blob/master/public/images/Screenshot%20(154).png)


#### Dashboard
![dashboard](https://github.com/sheikh005/LinkShortner/blob/master/public/images/Screenshot%20(155).png)

## Tech stack

 - Laravel (6.0) 
 -  PostgreSQL
 - [Bootswatch](https://bootswatch.com/) (Free Bootstrap themes)
 - #### Libraries/Packages used
  
   - [Jenssegers\Agent\Agent](https://github.com/jenssegers/agent) (A PHP desktop/mobile user agent parser)
   - [Math](https://gist.github.com/jgrossi/a4eb21bbe00763d63385) class to generate unique IDs. like `hV12gh` .



> Hosted on [Heroku](http://heroku.com) platform (With automatic deploys from this repo).
