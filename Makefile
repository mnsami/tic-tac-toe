COMPOSER ?= composer
DOCKER_COMPOSE = docker-compose
PROJECT = "TicTacToe."

ifeq ($(RUNNER), travis)
	CMD :=
else
	CMD := docker-compose exec php
endif

all: clear container-up lint-composer lint-php composer phpcs tests static-analysis

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
	$(CMD) bin/phpcs --standard=phpcs.xml -p

phpcbf:
	$(CMD) bin/phpcbf

coverage:
	$(CMD) bin/phpunit --coverage-html coverage

tests:
	@echo "\n==> Running tests"
	$(CMD) bin/phpunit

static-analysis:
	@echo "\n==> Running static analysis"
	$(CMD) bin/phpstan -l 7 -c phpstan.neon src tests

container-stop:
	@echo "\n==> Stopping docker container"
	$(DOCKER_COMPOSE) stop

container-down:
	@echo "\n==> Removing docker container"
	$(DOCKER_COMPOSE) down

container-up:
	@echo "\n==> Docker container building and starting ..."
	$(DOCKER_COMPOSE) up --build -d

tear-down: container-stop container-down


.PHONY: lint-php lint-composer phpcs phpcbf composer clear tests coverage container-up static-analysis container-stop container-down
