<?php declare(strict_types=1);

namespace MaxCurrency\Exception\Loggable;

/**
 * NotFoundException.
 *
 * @author Константин Штыков <konstantine.shtikov@yandex.ru>
 */
class NotFoundException extends \Exception implements ExceptionInterface
{
    public function __construct(string $message)
    {
        parent::__construct($message, 404);
    }
}
