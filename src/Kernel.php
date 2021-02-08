<?php declare (strict_types=1);

namespace MaxCurrency;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Kernel of currency parser
 * 
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
final class Kernel {

    /** @var \Curl\Curl */
    public $curl;

    public function __construct()
    {
        $this->curl = new \Curl\Curl();
    }
}