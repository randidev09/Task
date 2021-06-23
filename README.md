# Task

This project is for interview assignment

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

this command will open a new terminal & run the project.<br>
The frontend app will be run it on :
```http://172.17.0.2:8080/```<br>
and the backend app will be run it on :
```http://localhost/```<br>if you can't access the frontend app, you can see the url on the new terminal that opened earlier.