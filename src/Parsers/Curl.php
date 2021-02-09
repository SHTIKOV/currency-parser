<?php declare(strict_types=1);

namespace MaxCurrency\Parser;

use MaxCurrency\Exception\InternalServerException;
use MaxCurrency\Exception\NotFoundException;
use MaxCurrency\ParserAbstract;
use MaxCurrency\Entity\CurrencyData;

/**
 * Parser model of curl
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
final class Curl extends ParserAbstract
{
    protected function request(): CurrencyData
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

        return new CurrencyData($response);
    }
}
