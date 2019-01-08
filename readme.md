# Feedback-form

> A Laravel 5.6 project with (adminlte template)

![](https://github.com/Nikitagizatulin/feedback-form/blob/master/project-photo.png)

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

# and parallel start to laravel queue
php artisan queue:work --tries=3
```
## Functionality:
* registration \ login user (validated)
* reset password with sending password reset code to email
* create feedback form (validated) with some require file
* after the feedback form is created - the ability to send a new form is not possible within 24 hours.
* information about all of created feedback forms sent to admin in gmail. Each time when feedback form is created.
* admin can see all feedback form on such url: your_domain_name/fbAll
* admin can see delivered feedback forms