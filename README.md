<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Running the application

To get the app running:
1. Make sure you run `composer install` to install all required dependencies;
2. Make sure you create an .env file. This can be done by copying the contents of the 
`.env.example` file. After that, run the `php artisan key:generate` command to generate the app key;
3. Then, make sure you install all npm packages by calling `npm install`;
4. Once that is done, you can run the Vue3 frontend by calling the `npn run dev` command;
5. This app was built with the help of Sail and runs inside a docker container.
   Make sure you install docker desktop and then you can run the app by calling
   `./vendor/bin/sail up`from inside the directory where you place the App.
   This command will download and install all required images and will then run them. To create the basic DB structure, run the provided migrations with `php artisan migrate` (note this, including all subsequent artisan commands must be called from inside the docker container);
6. The created DB structure requires you to seed the one symbol, that is part of the task.
You can do that manually, or with the provided seeder - run the `php artisan db:seed`
command to do that;
7. The default installation of Laravel comes with register/login. I've decided
to use it. Please create an account to be able to open the main page;
8. Because of using queues and jobs, I also added Horizon to the app. You can start it and monitor all jobs and queues
   by running the artisan command - `php artisan horizon`;
9. The main job that's fetching the symbol data from the required API runs on a schedule (every minute).
You can start the local scheduler for testing the app by using `php artisan schedule:work` command;


With that, the App should be up and running at `http://localhost:8088`. The scheduler will run and populate the DB with data from 
the provided API endpoint.
To monitor Horizon you can use the default URL: `http://localhost:8088/horizon`
I'm using the provided default Mailpit server to receive the emails.
You can view all sent emails by visiting `http://localhost:8025`.

To test the app, run `php artisan test` inside the docker container.
I have provided a separate `.env.testing` file that points to a separate `testing` table
where all test data is stored (temporarily).


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

