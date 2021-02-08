STAN=./vendor/bin/phpstan --memory-limit=1024M

.PHONY: analyze
analyze:
	$(STAN) analyse -c phpstan.neon

.PHONY: tests
tests:
	./vendor/bin/phpunit --stop-on-error --stop-on-failure tests

.PHONY: example-download
example-download:
	php ./examples/download.php

.PHONY: example-print
example-print:
	php ./examples/print.php
