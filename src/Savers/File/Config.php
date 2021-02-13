<?php declare(strict_types=1);

namespace MaxCurrency\Saver\File;

use MaxCurrency\Exception\Loggable\NotFoundException;
use MaxCurrency\Exception\Loggable\InternalServerErrorException;
use MaxCurrency\ConfigAbstract;
use MaxCurrency\CommonClasses\FileSavableInterfase;

/**
 * Config for save to file
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
final class Config extends ConfigAbstract
{
    /** @var string */
    public $file;

    /** @var string */
    public $content = Config::DEFAULT_CONTENT;

    public function __construct(string $file, ?string $content = null)
    {
        $this->file = $file;
        if (!(null === $content)) {
            $this->content = $content;
        }
    }

    /**
     * @throws NotFoundException
     * @throws InternalServerErrorException
     */
    public function save(): void
    {
        if (ConfigAbstract::DEFAULT_CONTENT === $this->content) {
            throw new NotFoundException('Save: Content not found, before save you need prepare data.');
        }
        if (false === \file_put_contents($this->file, $this->content) && ($this->countRetries + 1) < ConfigAbstract::MAX_COUNT_RETRIES) {
            $this->countRetries++;
            $this->save();
            return;
        }

        $exception = null;
        if (ConfigAbstract::MAX_COUNT_RETRIES <= $this->countRetries) {
            $exception = new InternalServerErrorException('Save: Content not saved');
        }

        $this->countRetries = 0;
        $this->content = ConfigAbstract::DEFAULT_CONTENT;
        
        if (!(null === $exception)) {
            throw $exception;
        }
    }

    public function prepareData(FileSavableInterfase $entity): ConfigAbstract
    {
        $this->content = $entity->toFileString();
        return $this;
    }
}
