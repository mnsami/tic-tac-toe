COMPOSER ?= composer
PROJECT = "TicTacToe."

ifeq ($(RUNNER), travis)
	CMD :=
else
	CMD := docker-compose exec php
endif

all: clear lint-composer lint-php composer phpcs

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
	@echo "\n==> Running tests .. $(RUNNER)"
	$(CMD) bin/phpunit

build-docker:
	@echo "\n==> Docker container building and starting ..."
	docker-compose up --build -d


.PHONY: lint-php lint-composer phpcs phpcbf composer clear tests coverage build-docker
