<?php declare (strict_types=1);

/** Активируем переменные $argv и $argc */
ini_set('register_argc_argv', '1');

require_once __DIR__ . '/../src/ParserAbstract.php';

use MaxCurrency\Parser\Curl;
use MaxCurrency\Saver\File;

$currencies = ['AUD'];
if (1 < $argc) {
    $currencies = $argv;
    unset($currencies[0]);
}

$config = new File(__DIR__ . '/downloadedData.txt');

$curl = new Curl($config);
$curl->execute($currencies);

echo PHP_EOL . "        \e[1;32mDone!\e[0m" . PHP_EOL . PHP_EOL;