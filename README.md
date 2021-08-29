# ToDo App

## Requirements

- [docker](https://www.docker.com/products/docker-desktop)

  #### OR

- php >= 7.3 | php >= 8.0
- [composer](https://getcomposer.org/download/)
- MySQL
## Info
- [Laravel 8 Info](https://laravel.com/docs/8.x/installation)

## Installation/Configuration WITH DOCKER

### Install dependencies
#### MAC OS / Linux
```
docker run --rm -v $(pwd):/app composer install
```
#### Windows (Git Bash)
```
docker run --rm -v /$(pwd):/app composer install
```
#### Windows (Powershell)
```
docker run --rm -v ${PWD}:/app composer install
```

### Copy all file .env.example to .env

Change database configurations in **.env**

```
DB_CONNECTION=mysql
DB_HOST=mysql_todo_app
DB_PORT=3306
DB_DATABASE=yourdatabasename
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

### Configure PHPUnit file
change value line **25** phpunit.xml in **phpunit.xml**

```
<server name="DB_DATABASE" value="yourdatabasename"/>
```


### Detach the application

```
docker-compose up -d
```

### Generate APP Key
```
docker-compose exec app php artisan key:generate
```
### Run the migrations and seed script
```
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```
### Open browser http://localhost:8000
### Login
- Go your database and seed the fake users created and choose one
- Password for users -> **password**

## Installation/Configuration WITHOUT DOCKER
### Install dependencies
```
composer install
```
### Copy .env.example to .env

Change database configurations in **.env**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yourdatabase
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

### Generate APP Key

```
php artisan key:generate
```

### Run the migrations and seed script
```
php artisan migrate
php artisan db:seed
```

### Run server

```
php artisan serve
```

### Open browser http://localhost:8000
### Login
- Go your database and seed the fake users created and choose one
- Password for users -> **password**


