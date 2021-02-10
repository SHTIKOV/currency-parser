<?php declare (strict_types=1);

require_once __DIR__ . '/../src/ParserAbstract.php';

$curlParser = new MaxCurrency\Parser\Curl();
$data = $curlParser->getCurrencyData('AUD');
dump($data);

$fileParser = new MaxCurrency\Parser\File();
$data = $fileParser->getCurrencyData('AUD');
dump($data);

