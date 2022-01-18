This is the laravel solution to the drone delivery coding assignment, To run the project composer is needed, the project was built on PHP 7.3.2 and Laravel 4.2.9 .
You can see all the API endpoints documentation on Postman here https://documenter.getpostman.com/view/19201032/UVXkovWF

<h2>Build Instructions</h2>:
From your comand line, run the following;
1) git clone https://github.com/Locke-bot/drones_delivery.git
2) cd drones_delivery
3) run composer install 
4) run mv .env.example .env 
5) run php artisan cache:clear 
6) run composer dump-autoload 
7) run php artisan key:generate
8) a sqlite database is in use, comment out the default mysql DB connection in the'.env' file
9) set DB_CONNECTION = sqlite
10) set DB_HOST=127.0.0.1; ;DB_PORT=3306; DB_DATABASE=/path/to/drones_delivery/database/database.sqlite

<span style="font-size:larger;">Run Instructions</span>:
1) cd to the drones_delivery folder
2) run php artisan serve

The project will be served on http://localhost:8000/api/{routes}.
