# Task

This is personal project, created using Laravel (Backend) & Vue JS (Frontend) with Docker Environment.

## Installation

When first time cloning the project, you need to install the project first, after that you can run it everytime you want without install it first.

* Build the backend, go to `/backend` directory and run this command :

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```

* Build the frontend, go to root directory which is `/task`, and run this command :

```bash
make build_frontend
```

## Usage

go to root directory which is `/task`, and run this command :
```bash
make setup
```

this command will open a new terminal & run the project, its may take some times.<br>
The frontend app will be run it on :
```http://localhost:8080/```<br>
and the backend app will be run it on :
```http://localhost/```<br>if you can't access the frontend app, you can see the url on the new terminal that opened earlier.

* After the containers is running, please do the migration, go to `/backend` directory and run this command :

```console
make migrate
```

## Register Workflow

```console
1. Register user on frontend App
2. User verify email address in local with accessing this URL http://0.0.0.0:8025/ (Mailhog)
3. User click the link on the email and will be redirecting to the frontend app again
```

## API Documentation

You can import API documentation with this link :
```console
https://www.getpostman.com/collections/af639735bfdcba550c2a
```
