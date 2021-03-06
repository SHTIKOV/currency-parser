<?php declare(strict_types=1);

namespace MaxCurrency;

require_once __DIR__ . '/../vendor/autoload.php';

use MaxCurrency\CommonClasses\FileSavableInterfase;

/**
 * SaverAbstract
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
abstract class SaverAbstract
{
    const DEFAULT_CONTENT = 'NONE';
    const MAX_COUNT_RETRIES = 3;

    /** @var int */
    protected $countRetries = 0;

    /**
     * @param array<FileSavableInterfase> $entities
     */
    abstract public function prepareData(array $entities): SaverAbstract;

    abstract public function save(): void;
}
