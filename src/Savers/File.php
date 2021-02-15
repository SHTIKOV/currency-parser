<?php declare(strict_types=1);

namespace MaxCurrency\Saver;

use MaxCurrency\Exception\Loggable\NotFoundException;
use MaxCurrency\Exception\Loggable\InternalServerErrorException;
use MaxCurrency\SaverAbstract;
use MaxCurrency\CommonClasses\FileSavableInterfase;

/**
 * File for save to file
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
final class File extends SaverAbstract
{
    /** @var string */
    public $file;

    /** @var string */
    public $content = File::DEFAULT_CONTENT;

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
        if (SaverAbstract::DEFAULT_CONTENT === $this->content) {
            throw new NotFoundException('Save: Content not found, before save you need prepare data.');
        }
        if (false === \file_put_contents($this->file, $this->content) && ($this->countRetries + 1) < SaverAbstract::MAX_COUNT_RETRIES) {
            $this->countRetries++;
            $this->save();
            return;
        }

        $exception = null;
        if (SaverAbstract::MAX_COUNT_RETRIES <= $this->countRetries) {
            $exception = new InternalServerErrorException('Save: Content not saved');
        }

        $this->countRetries = 0;
        $this->content = SaverAbstract::DEFAULT_CONTENT;
        
        if (!(null === $exception)) {
            throw $exception;
        }
    }

    /**
     * @param array<FileSavableInterfase> $entities
     */
    public function prepareData(array $entities): SaverAbstract
    {
        $this->content = '';
        foreach ($entities as $index => $entity) {
            $eol = $index === count($entities) - 1 ? '' : PHP_EOL;
            $this->content .= $entity->toFileString() . $eol;
        }
        return $this;
    }
}
