CMD = docker-compose exec php
COMPOSER ?= composer
PROJECT = "TicTacToe."

all: clear lint-composer lint-php composer phpcs play

lint-composer:
	@echo "\n==> Validating composer.json and composer.lock:"
	$(CMD) $(COMPOSER) validate --strict

lint-php:
	@echo "\n==> Validating all php files:"
	@find src -type f -name \*.php | while read file; do php -l "$$file" || exit 1; done

composer:
	$(CMD) $(COMPOSER) install

clear:
	$(CMD) rm -rf vendor

phpcs:
	$(CMD) bin/phpcs --standard=phpcs.xml -p

phpcbf:
	$(CMD) bin/phpcbf

play:
	$(CMD) bin/App.php

coverage:
	$(CMD) bin/phpunit --coverage-html coverage

tests:
	$(CMD) bin/phpunit


.PHONY: lint-php lint-composer phpcs phpcbf composer clear play tests coverage
