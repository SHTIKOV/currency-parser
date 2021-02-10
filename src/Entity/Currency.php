<?php declare(strict_types=1);

namespace MaxCurrency\Entity;

use MaxCurrency\CommonClasses\FillableAbstract;

/**
 * Currency
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
class Currency extends FillableAbstract
{
    const DEFAULT_NAME = 'None';

    /** @var string|null */
    private $id;
    /** @var string|null */
    private $numCode;
    /** @var string|null */
    private $charCode;
    /** @var int */
    private $nominal = 1;
    /** @var string */
    private $name = Currency::DEFAULT_NAME;
    /** @var float */
    private $value = 0.0;
    /** @var float */
    private $previous = 0.0;

    
    protected function fill(array $data): Currency
    {
        $this->setId($data['ID']);
        $this->setNumCode($data['NumCode']);
        $this->setCharCode($data['CharCode']);
        $this->setNominal($data['Nominal']);
        $this->setName($data['Name']);
        $this->setValue($data['Value']);
        $this->setPrevious($data['Previous']);

        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): Currency
    {
        $this->id = $id;

        return $this;
    }

    public function getNumCode(): ?string
    {
        return $this->numCode;
    }

    public function setNumCode(?string $numCode): Currency
    {
        $this->numCode = $numCode;

        return $this;
    }

    public function getCharCode(): ?string
    {
        return $this->charCode;
    }

    public function setCharCode(?string $charCode): Currency
    {
        $this->charCode = $charCode;

        return $this;
    }

    public function getNominal(): int
    {
        return $this->nominal;
    }

    public function setNominal(int $nominal): Currency
    {
        $this->nominal = $nominal;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Currency
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): Currency
    {
        $this->value = $value;

        return $this;
    }

    public function getPrevious(): float
    {
        return $this->previous;
    }

    public function setPrevious(float $previous): Currency
    {
        $this->previous = $previous;

        return $this;
    }
}
