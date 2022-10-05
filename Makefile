COMPOSER ?= composer
DOCKER_COMPOSE = docker-compose
PROJECT = "TicTacToe."
COMPOSE_PROJECT_NAME ?= $(notdir $(shell pwd))
PHP_SERVICE = php
PHP_CMD = php

ifeq ($(RUNNER), PIPELINE)
	CMD :=
else
	CMD := docker-compose exec $(PHP_SERVICE)
endif

all: container-up clear composer lint-composer lint-php  phpcs tests

lint-composer:
	@echo "\n==> Validating composer.json and composer.lock:"
	$(CMD) $(COMPOSER) validate --strict

lint-php:
	@echo "\n==> Validating all php files:"
	$(CMD) find src -type f -iname '*php' -exec $(PHP_CMD) -l {} \;

composer:
	@echo "\n==> Running composer install, runner $(RUNNER)"
	$(CMD) $(COMPOSER) install

lint: lint-composer lint-php

clear:
	$(CMD) rm -rf vendor
	$(CMD) rm -rf bin/php*

phpcs:
	@echo "\n==> Checking style guidelines"
	$(CMD) bin/phpcs --standard=phpcs.xml -p

phpcbf:
	$(CMD) bin/phpcbf

coverage:
	@echo "\n==> Generating coverage report"
	$(CMD) bin/phpunit --coverage-html coverage

tests:
	@echo "\n==> Running tests"
	$(CMD) bin/phpunit

stan:
	@echo "\n==> Running stan for analysis"
	$(CMD) bin/phpstan analyse --memory-limit=-1 src

container-stop:
	@echo "\n==> Stopping docker container"
	$(DOCKER_COMPOSE) stop

container-down:
	@echo "\n==> Removing docker container"
	$(DOCKER_COMPOSE) down

container-remove:
	@echo "\n==> Removing docker container(s)"
	$(DOCKER_COMPOSE) rm

container-up:
	@echo "\n==> Docker container building and starting ..."
	$(DOCKER_COMPOSE) up --build -d

tear-down: clear container-stop container-down container-remove


.PHONY: lint-php lint-composer phpcs phpcbf composer clear tests coverage container-up container-stop container-down container-remove