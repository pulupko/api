# api
It's a simple application

## Requirements
- PHP 7.0+
- MySQL 5.7


## Instalation 
clone project from this repository

edit ```.env.local``` file

Set your database configs

```
DATABASE_URL="mysql://db_user:db_password127.0.0.1:3306/db_name?serverVersion=5.7""
```

install composer 

```
composer install
```

create database

```
php bin/console doctrine:database:create
```

create schema 
```
php bin/console doctrine:schema:create
```

load dump


## Usage

API uses JSON raw data.

API routes:
```
GET /api/classroom/list - returns all classrooms

GET /api/classroom/show/{id} - return classroom by id

DELETE /api/classroom/delete/{id} - delete classroom

POST /api/classroom/create - create new classroom
      raw data example:
        {
          "name": "classroom",
          "is_active": 1
        }
PUT /api/classroom/update/{id} - update existing classroom 
      raw data example:
        {
          "name": "classroom",
          "is_active": 1
        }

PATCH /api/classroom/change-status/{id} - change status
      raw data example:
        {
          "is_active": 1
        }
```

