STAN=./vendor/bin/phpstan --memory-limit=1024M
CS_FIXER=./vendor/bin/php-cs-fixer

.PHONY: analyze
analyze:
	$(STAN) analyse -c phpstan.neon

.PHONY: tests
tests:
	./vendor/bin/phpunit --stop-on-error --stop-on-failure ./tests/ParserTest.php 

.PHONY: example-download
example-download:
	php ./examples/download.php

.PHONY: example-print
example-print:
	php ./examples/print.php

cs-fix:
	$(CS_FIXER) fix src
