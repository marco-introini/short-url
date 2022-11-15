# Short URL

Open source (MIT license) project for creating a self-hosted URL shortener using Docker container

## Installation

### Using Docker

There is a preconfigured .env.docker file you can customize if you want. The Dockerfile install PHP 8.1 with Apache2 and NodeJS.

To use it simply execute:

```
docker compose up 
```

To create the first environment inside the container terminal go in /var/www/html directory and execute `make first_production`

Now you can use admin area and APIs

```
http://localhost:8005/admin
```

### Local installation

You can use this program in any directory you want.

#### Prerequisites

- PHP version 8.1 or above
- composer
- a configured web server or Laravel Valet
- a database

#### Installation Steps

- clone the repository
- put the Document Root to the public directory
- create a .env file (see .env-example for an example file)
- inside the project root execute `make first_production`

This will create the database and download every composer package needed

## GUI

You can control everything using the provided administration area, located at `/admin` route.

### Url Administration

You can list and create the complete URLs for your user in this panel:

![Url list](readme_img1.png)

Inside the Url detail you can see the complete log calls

![Url list](readme_img2.png)


## APIs

### Registration and Login

/api/register

/api/login

### Urls API

/api/url

Protected with Sanctum, so it needs the bearer token obtained via login
