setup:
	npm install && docker run -it -p 8000:8000 --rm --name dockerize-vuejs-app-1 vuejs-cookbook/dockerize-vuejs-app
build:
	docker build -t vuejs-cookbook/dockerize-vuejs-app .
destroy:
	docker stop dockerize-vuejs-app-1 vuejs-cookbook/dockerize-vuejs-app
