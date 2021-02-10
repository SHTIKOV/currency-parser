<?php declare(strict_types=1);

namespace MaxCurrency\Exception\Loggable;

use MaxCurrency\Exception;

/**
 * BadRequestException.
 *
 * @author Константин Штыков <konstantine.shtikov@yandex.ru>
 */
class BadRequestException extends Exception\BadRequestException implements ExceptionInterface
{

}
