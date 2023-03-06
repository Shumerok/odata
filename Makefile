
DOCKER_COMPOSE = docker-compose
DOCKER_EXEC = docker exec -it odata_php

build:
	${DOCKER_COMPOSE} build

up:
	${DOCKER_COMPOSE} up -d

down:
	${DOCKER_COMPOSE} down

migrate:
	${DOCKER_EXEC} php artisan migrate

seed:
	${DOCKER_EXEC} php artisan db:seed

test:
	${DOCKER_EXEC} php artisan test

fresh:
	${DOCKER_EXEC} php artisan m:fr

composer:
	${DOCKER_EXEC} composer install

php:
	${DOCKER_EXEC} bash

pause:
	sleep 3

restart:
	make down up

init:
	make build up composer migrate print


