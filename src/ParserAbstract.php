<?php declare(strict_types=1);

namespace MaxCurrency;

require_once __DIR__ . '/../vendor/autoload.php';

use MaxCurrency\CommonClasses\FillableAbstract;
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

    /** @var SaverAbstract */
    private $config;


    public function __construct(SaverAbstract $config)
    {
        $this->config = $config;
        $this->logger = new Logger($this->getLoggerName());
        $this->logger->pushHandler(new StreamHandler('var/logs.log', Logger::WARNING));
    }


    abstract protected function getLoggerName(): string;

    abstract protected function request(): Response;

    public function setConfig(SaverAbstract $config): ParserAbstract
    {
        $this->config = $config;
        return $this;
    }

    public function getConfig(): SaverAbstract
    {
        return $this->config;
    }

    /**
     * @param array<string> $currencies
     */
    public function execute(array $currencies = []): void
    {
        try {
            /** @var Response */
            $response = $this->request();

            $entities = $response->getValute($currencies);
            $this->config->prepareData($entities)->save();
        } catch (\Throwable $th) {
            if ($th instanceof LoggableExceptionInterface) {
                $this->logger->error('Message: '.$th->getMessage().', Error code: '.$th->getCode());
            }
            throw $th;
        }
    }
}
