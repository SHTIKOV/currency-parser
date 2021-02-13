<?php declare (strict_types=1);

require_once __DIR__ . '/../src/ParserAbstract.php';

use MaxCurrency\Parser\Curl;
use MaxCurrency\Saver\File;

$config = new File(__DIR__ . '/downloadedData.txt');

$curl = new Curl($config);
$curl->execute();

echo PHP_EOL . "        \e[1;32mDone!\e[0m" . PHP_EOL . PHP_EOL;