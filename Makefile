COMPOSER ?= composer
PROJECT = "Tic-Tac-Toe"

all: clear lint-composer lint-php composer phpcs test coverage

lint-composer:
	@echo "\n==> Validating composer.json and composer.lock:"
	$(COMPOSER) validate --strict

lint-php:
	@echo "\n==> Validating all php files:"
	@find src -type f -name \*.php | while read file; do php -l "$$file" || exit 1; done

composer:
	$(COMPOSER) install

clear:
	rm -rf vendor

phpcs:
	php vendor/bin/phpcs . -np

phpcbf:
	vendor/bin/phpcbf src/*

test:
	vendor/bin/phpunit

coverage:
	vendor/bin/phpunit --coverage-html coverage

.PHONY: lint-php lint-composer phpcs phpcbf test coverage composer clear
