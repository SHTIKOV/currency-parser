<?php declare(strict_types=1);

namespace MaxCurrency;

require_once __DIR__ . '/../vendor/autoload.php';

use MaxCurrency\CommonClasses\FileSavableInterfase;

/**
 * ConfigAbstract
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
abstract class ConfigAbstract
{
    const DEFAULT_CONTENT = 'NONE';
    const MAX_COUNT_RETRIES = 3;

    /** @var int */
    protected $countRetries = 0;

    abstract public function prepareData(FileSavableInterfase $entity): ConfigAbstract;

    abstract public function save(): void;
}
