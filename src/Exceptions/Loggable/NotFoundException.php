<?php declare(strict_types=1);

namespace MaxCurrency\Exception\Loggable;

use MaxCurrency\Exception;

/**
 * NotFoundException.
 *
 * @author Константин Штыков <konstantine.shtikov@yandex.ru>
 */
class NotFoundException extends Exception\BadRequestException implements ExceptionInterface
{
}
