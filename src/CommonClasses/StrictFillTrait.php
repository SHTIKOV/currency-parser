<?php declare(strict_types=1);

namespace MaxCurrency\CommonClasses;

use MaxCurrency\Exception\BadRequestException;

/**
 * Strict fill
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
trait StrictFillTrait
{
    /**
     * @param array<mixed> $data
     */
    protected function checkFields(array $data): self
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
