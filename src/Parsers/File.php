<?php declare(strict_types=1);

namespace MaxCurrency\Parser;

use MaxCurrency\Exception\InternalServerException;
use MaxCurrency\Exception\Loggable\NotFoundException;
use MaxCurrency\ParserAbstract;
use MaxCurrency\Response;

/**
 * Parser model of file
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
final class File extends ParserAbstract
{
    protected function getLoggerName(): string
    {
        return 'FileParser';
    }

    protected function request(): Response
    {
        $response = json_decode(file_get_contents(ParserAbstract::API_URL), true);
        if (!(JSON_ERROR_NONE === json_last_error())) {
            throw new InternalServerException();
        }

        if (1 > count($response)) {
            throw new NotFoundException('Response not found');
        }

        return new Response($response);
    }
}
