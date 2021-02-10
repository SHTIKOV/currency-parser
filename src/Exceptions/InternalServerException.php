<?php declare(strict_types=1);

namespace MaxCurrency\Exception;

/**
 * InternalServerException.
 *
 * @author Константин Штыков <konstantine.shtikov@yandex.ru>
 */
class InternalServerException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Internal server error', 500);
    }
}
