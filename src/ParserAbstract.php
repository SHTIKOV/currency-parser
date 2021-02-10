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
abstract class ParserAbstract
{
    const API_URL = 'https://www.cbr-xml-daily.ru/daily_json.js';

    /** @var Logger */
    public $logger;

    /** @var ConfigAbstract */
    private $config;


    public function __construct(ConfigAbstract $config)
    {
        $this->logger = $config;
        $this->logger = new Logger($this->getLoggerName());
        $this->logger->pushHandler(new StreamHandler('var/logs.log', Logger::WARNING));
    }


    abstract protected function getLoggerName(): string;

    abstract protected function request(): Response;

    public function setConfig(ConfigAbstract $config): ParserAbstract
    {
        $this->config = $config;
        return $this;
    }

    public function execute(string $currency): Currency
    {
        try {
            /** @var Response */
            $response = $this->request();

            $currency = $response->getValute($currency);
        } catch (\Throwable $th) {
            if ($th instanceof LoggableExceptionInterface) {
                $this->logger->error('Message: '.$th->getMessage().', Error code: '.$th->getCode());
            }
            throw $th;
        }
    }
}
