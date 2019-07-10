COMPOSER ?= composer
DOCKER_COMPOSE = docker-compose
PROJECT = "TicTacToe."

ifeq ($(RUNNER), travis)
	CMD :=
else
	CMD := docker-compose exec php
endif

all: container-up clear composer lint-composer lint-php  phpcs tests

lint-composer:
	@echo "\n==> Validating composer.json and composer.lock:"
	$(CMD) $(COMPOSER) validate --strict

lint-php:
	@echo "\n==> Validating all php files:"
	@find src -type f -name \*.php | while read file; do php -l "$$file" || exit 1; done

composer:
	@echo "\n==> Running composer install, runner $(RUNNER)"
	$(CMD) $(COMPOSER) install

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

container-stop:
	@echo "\n==> Stopping docker container"
	$(DOCKER_COMPOSE) stop

container-down:
	@echo "\n==> Removing docker container"
	$(DOCKER_COMPOSE) down

container-up:
	@echo "\n==> Docker container building and starting ..."
	$(DOCKER_COMPOSE) up --build -d

tear-down: clear container-stop container-down


.PHONY: lint-php lint-composer phpcs phpcbf composer clear tests coverage container-up static-analysis container-stop container-down
