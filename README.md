# Nuntius - API

Nuntius is an open source platform for agricultural services' provider.

## Features

* Users and roles management
* Contacts management
* Inventory management
* Employee management
* Time tracking

## System dependencies

* PHP 7.1 (php interpreter)
* MySQL / MariaDB (Database)
* RabbitMQ (Queue management)
* NodeJS (javascript interpreter)

## Laravel Dependencies

* laravel/passport (API authentication)
* zizaco/entrust (Role and Permissions management)
* barryvdh/laravel-cors (Send CORS headers)
* spaties/laravel-backup (Create application backup)
* spaties/laravel-activitylog (Log users activities)
* spaties/laravel-sluggable (Create slug for models)
* pragmarx/countries (List countries info)

## Installation

* clone the git depot and install dependencies

```bash
$ git clone #...
$ cd #...
$ composer install
$ npm install
```

* create .env file (you can follow the .env.example file)
* migrate the database
* generate laravel, passport keys
* seed the database with default users, roles and permissions

> NB._ If you are using a database other then MySQL you need to update database parameters in config/backup.php (supported databases are MySQL, PostgreSQL, SQLite and MongoDB)

```bash
$ php artisan migrate
$ php artisan key:generate
$ php artisan passport:keys
```

* create cron jobs

```bash
# Create application and database backup
php APP_ROOT/artisan backup:run --only-db >> /dev/null 2>&1

# Clean activity logger logs
php APP_ROOT/artisan activitylog:clean >> /dev/null 2>&1
```

## @TODO

* Add API scopes
* Create roles and permission seeder
* Create default user seeder
