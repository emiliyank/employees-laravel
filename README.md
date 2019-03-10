# employees-laravel

##Instructions
1. clone this repository [https://github.com/emiliyank/employees-laravel.git](https://github.com/emiliyank/employees-laravel.git)
1. run `composer update`
1. generate project key `php artisan key:generate`
1. setup environment variables: DB settings and `QUEUE_CONNECTION=databse`
1. run migrations `php artisan migrate`
1. run seeds `php artisan db:seed`
1. create symlink for upload images `php artisan storage:link`
1. Sending emails is queued so you need to start queues on background if you want the emails to be send `php artisan queue:work`