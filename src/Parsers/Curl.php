<?php declare(strict_types=1);

namespace MaxCurrency\Parser;

use MaxCurrency\Exception\InternalServerException;
use MaxCurrency\Exception\Loggable\NotFoundException;
use MaxCurrency\ParserAbstract;
use MaxCurrency\Response;

/**
 * Parser model of curl
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
final class Curl extends ParserAbstract
{
    protected function getLoggerName(): string
    {
        return 'CurlParser';
    }

    protected function request(): Response
    {
        $curl = new \Curl\Curl();
        $curl->get(ParserAbstract::API_URL);

        $response = json_decode($curl->response, true);
        if (!$curl->isSuccess() || !(JSON_ERROR_NONE === json_last_error())) {
            throw new InternalServerException();
        }
        
        if (1 > count($response)) {
            throw new NotFoundException('Response not found');
        }

        return new Response($response);
    }
}
