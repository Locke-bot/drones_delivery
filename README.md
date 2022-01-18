This is the laravel solution to the drone delivery coding assignment, to run the project, composer is needed, the project was built on PHP 7.3.2 and Laravel 4.2.9 .
You can see all the API endpoints documentation on Postman here https://documenter.getpostman.com/view/19201032/UVXkovWF

<h2>Build Instructions:</h2>
From your comand line, run the following;<br><br>
<ul>
    <li>git clone https://github.com/Locke-bot/drones_delivery.git</li>
    <li>cd drones_delivery</li>
    <li>run composer install</li>
    <li>run mv .env.example .env</li>
    <li>run php artisan cache:clear</li>
    <li>run composer dump-autoload</li>
    <li>run php artisan key:generate</li>
    <li>a sqlite database is in use, comment out the default mysql DB connection in the'.env' file</li>
    <li>set DB_CONNECTION = sqlite</li>
    <li>set DB_HOST=127.0.0.1; ;DB_PORT=3306; DB_DATABASE=/path/to/drones_delivery/database/database.sqlite</li>
</ul>

<h2>Run Instructions:</h2>
<ul>
    <li>cd to the drones_delivery folder</li>
    <li>run php artisan serve</li>
 </ul>

The project will be served on http://localhost:8000/api/{routes}.
