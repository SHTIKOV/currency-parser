<?php declare (strict_types=1);

require_once __DIR__ . '/../src/ParserAbstract.php';

use MaxCurrency\Parser\{
    Curl,
    File
};

$data = (new Curl())->getCurrencyData('AUD');
dump($data);

$data = (new File())->getCurrencyData('AUD');
dump($data);

