setup:
	./vendor/bin/sail up
build:
	docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/opt -w /opt laravelsail/php80-composer:latest composer install --ignore-platform-reqs
destroy:
	./vendor/bin/sail down