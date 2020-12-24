install:
	php composer.phar install

validate:
	php composer.phar validate

lint:
	php composer.phar run-script phpcs -- --standard=PSR12 src bin
