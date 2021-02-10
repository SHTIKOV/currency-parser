<?php declare(strict_types=1);

namespace MaxCurrency;

require_once __DIR__ . '/../vendor/autoload.php';

use MaxCurrency\Entity\Currency;
use MaxCurrency\Response;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use MaxCurrency\Exception\Loggable\ExceptionInterface as LoggableExceptionInterface;

/**
 * Parser
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
abstract class ConfigAbstract
{
    abstract public function save(): void;
}
