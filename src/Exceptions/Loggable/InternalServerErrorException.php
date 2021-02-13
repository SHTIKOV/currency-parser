<?php declare(strict_types=1);

namespace MaxCurrency\Exception\Loggable;

use MaxCurrency\Exception;

/**
 * InternalServerErrorException.
 *
 * @author Константин Штыков <konstantine.shtikov@yandex.ru>
 */
class InternalServerErrorException extends Exception\BadRequestException implements ExceptionInterface
{
}
