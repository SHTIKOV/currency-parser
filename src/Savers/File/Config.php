<?php declare(strict_types=1);

namespace MaxCurrency\Saver\File;

use MaxCurrency\Exception\InternalServerException;
use MaxCurrency\Exception\Loggable\NotFoundException;
use MaxCurrency\ConfigAbstract;
use MaxCurrency\Response;
use MaxCurrency\Entity\Currency;

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
    public $content;

    public function __construct(string $file, string $content)
    {
        $this->file = $file;
        $this->content = $content;
    }

    public function save(): void
    {
        file_put_contents($this->file, $this->content);
    }

    public function prepareData(Currency $data): Config
    {
        
        return $this;
    }
}
