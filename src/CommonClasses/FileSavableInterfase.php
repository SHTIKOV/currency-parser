<?php declare(strict_types=1);

namespace MaxCurrency\CommonClasses;

/**
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
interface FileSavableInterfase
{
    public function toFileString(): string;
}
