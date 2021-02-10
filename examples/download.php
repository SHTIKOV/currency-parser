<?php declare (strict_types=1);

require_once __DIR__ . '/../src/ParserAbstract.php';

ini_set('register_argc_argv', '1');

use MaxCurrency\Parser\{
    Curl,
    File
};

if ($argc > 2) {
    echo "
        \e[1;31mOnly one argument required\e[0m

";
    exit;
}

$currency = 'AUD';
if ($argc > 1) {
    $currency = $argv[1];
}

$data = (new Curl())->getCurrencyData($currency);
dump($data);

$data = (new File())->getCurrencyData($currency);
dump($data);

echo "
        \e[1;32mDone!\e[0m

";