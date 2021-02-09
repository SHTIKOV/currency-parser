<?php declare (strict_types=1);

require_once __DIR__ . '/../src/Parser.php';

$parser = new MaxCurrency\Parser\Curl();
dump($parser->getCurrencyData('AUD'));

$parser = new MaxCurrency\Parser\File();
dump($parser->getCurrencyData('AUD'));

