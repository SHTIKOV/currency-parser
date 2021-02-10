<?php declare(strict_types=1);

namespace MaxCurrency\Exception;

/**
 * BadRequestException.
 *
 * @author Константин Штыков <konstantine.shtikov@yandex.ru>
 */
class BadRequestException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message, 400);
    }
}
