<?php declare(strict_types=1);

namespace MaxCurrency\CommonClasses;

use MaxCurrency\Exception\BadRequestException;

/**
 * Strict fill
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
abstract class FillableAbstract
{
    /**
     * @param array<mixed> $data
     */
    public function __construct(array $data)
    {
        $this->checkFields($data);
        $this->fill($data);
    }


    /**
     * @param array<mixed> $data
     */
    abstract protected function fill(array $data): FillableAbstract;
    
    /**
     * @param array<mixed> $data
     */
    private function checkFields(array $data): FillableAbstract
    {
        $fields = array_keys($data);
        foreach ($fields as $fieldName) {
            if (!isset($data[$fieldName])) {
                throw new BadRequestException('Fields: '.implode(', ', $fields).' are required');
            }
        }

        return $this;
    }
}
