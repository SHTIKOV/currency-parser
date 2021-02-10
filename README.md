# Currency parcer engine

## Requipments
#### Dev:
```json
{
    "phpunit/phpunit": "^9.3",
    "symfony/var-dumper": "^5.2",
    "phpstan/phpstan": "^0.12.73",
    "friendsofphp/php-cs-fixer": "^2.18"
}
```
#### Main:
```json
{
    "curl/curl": "2.3.1",
    "monolog/monolog": "^2.2"
}
```

## How to install
To install, run the following some command:
In first time you need clone repository and then install vendors in project.
```
composer install
```

## Examples
For examples you has two commands: `download` and `print`.
##### Download:
```bash
$ php examples/download.php EUR
```
##### Print:
```bash
$ php examples/print.php EUR
```
##### Test command:
```bash
$ make example-download
```
```bash
$ make example-print
```
For more see **Makefile**.

## How to use
```php
<?php
use MaxCurrency\Parser\Curl;

$currency = (new Curl())->execute($currency);
```
