.PHONY: up stop php assets

PHP_CLI_ROOT=docker-compose exec php
PHP_CLI=docker-compose exec php

up:
	docker-compose up -d --remove-orphans
	php bin/console server:start
	#$(PHP_CLI_ROOT) chown -R 33:33 /var/www

stop:
	docker-compose stop
	php bin/console server:stop

php:
	$(PHP_CLI_ROOT) /bin/bash

assets:
	yarn encore dev