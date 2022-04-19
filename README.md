# ToDo App

## Requirements

- [Docker](https://www.docker.com/products/docker-desktop)

  #### OR

- php >= 8.0
- [Composer](https://getcomposer.org/download/)
- MySQL
## Info
- [Laravel 9 Info](https://laravel.com/docs/9.x/installation)

## Installation/Configuration WITH DOCKER

### Install dependencies
#### macOS / Linux
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

In terminal if you use macOS / Linux / Git Bash(Windows)

```
cp .env.example .env
```

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
docker-compose exec app php artisan migrate --seed
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

### Configure PHPUnit file
change value line **25** phpunit.xml in **phpunit.xml**

```
<server name="DB_DATABASE" value="yourdatabasename"/>
```

### Generate APP Key

```
php artisan key:generate
```

### Run the migrations and seed script
```
php artisan migrate --seed
```

### Run server

```
php artisan serve
```

### Open browser http://localhost:8000

### Login

- Go your database and seed the fake users created and choose one
- Password for users -> **password**

### Configure Access Local Database

```
Host: 127.0.0.1
Port: 3308
Username : root
Password: yourdatabasepassword
```

## Production

### Open browser https://production-todo-app.herokuapp.com

### Login

- user-test@example.com
- Password for users -> **password**

