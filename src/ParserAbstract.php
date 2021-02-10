<?php declare(strict_types=1);

namespace MaxCurrency;

require_once __DIR__ . '/../vendor/autoload.php';

use MaxCurrency\Entity\Currency;
use MaxCurrency\Response;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Parser
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
abstract class ParserAbstract
{
    const API_URL = 'https://www.cbr-xml-daily.ru/daily_json.js';

    /** @var Logger */
    public $logger;


    public function __construct()
    {
        $this->logger = new Logger($this->getLoggerName());
        $this->logger->pushHandler(new StreamHandler('var/logs.log', Logger::WARNING));
    }


    public function getCurrencyData(string $currency): Currency
    {
        try {
            /** @var Response */
            $currencyData = $this->request();
            return $currencyData->getValute($currency);
        } catch (\Throwable $th) {
            $this->logger->error('Message: '.$th->getMessage().', Error code: '.$th->getCode());
            throw $th;
        }
    }

    abstract protected function getLoggerName(): string;

    abstract protected function request(): Response;
}
