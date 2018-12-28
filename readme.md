# Feedback-form

> A Laravel 5.6 project with (adminlte template)

## Build Setup

``` bash
# first what you need - install package dependencies
composer install

# rename .env.example to .env and pass in this file settings
mv .env.example .env

# generate key for our project
php artisan key:generate

# create all table fro project
php artisan migrate

# run this code for create the symbolic link. *require
php artisan storage:link

#if you want get fake data run this
php artisan db:seed

# now run the project 
php artisan serve
```
