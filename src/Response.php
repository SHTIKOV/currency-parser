<?php declare(strict_types=1);

namespace MaxCurrency;

use MaxCurrency\Exception\Loggable\NotFoundException;
use MaxCurrency\CommonClasses\FillableAbstract;
use MaxCurrency\Entity\Currency;

/**
 * Response
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
class Response extends FillableAbstract
{
    const DEFAULT_NAME = 'None';

    /** @var \DateTime|null */
    private $date;
    /** @var \DateTime|null */
    private $previousDate;
    /** @var string|null */
    private $previousURL;
    /** @var int */
    private $timestamp = 0;
    /** @var Currency[] */
    private $valutes = [];


    protected function fill(array $data): Response
    {
        $this->setDate(new \DateTime($data['Date']));
        $this->setPreviousDate(new \DateTime($data['PreviousDate']));
        $this->setPreviousUrl($data['PreviousURL']);
        $this->setTimestamp((new \DateTime($data['Timestamp']))->getTimestamp());
        $this->setValutes($data['Valute']);

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(?\DateTime $date): Response
    {
        $this->date = $date;

        return $this;
    }

    public function getPreviousDate(): ?\DateTime
    {
        return $this->previousDate;
    }

    public function setPreviousDate(?\DateTime $previousDate): Response
    {
        $this->previousDate = $previousDate;

        return $this;
    }

    public function getPreviousURL(): ?string
    {
        return $this->previousURL;
    }

    public function setPreviousURL(?string $previousURL): Response
    {
        $this->previousURL = $previousURL;

        return $this;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp): Response
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @return array<Currency>
     */
    public function getValutes(): array
    {
        return $this->valutes = array_map(function ($valute) {
            if (!($valute instanceof Currency)) {
                $valute = new Currency($valute);
            }
            return $valute;
        }, $this->valutes);
    }

    /**
     * @param array<Currency> $valutes
     */
    public function setValutes(array $valutes): Response
    {
        $this->valutes = $valutes;

        return $this;
    }

    public function hasValute(string $charCode): bool
    {
        foreach ($this->getValutes() as $valute) {
            if ($charCode === $valute->getCharCode()) {
                return true;
            }
        }

        return false;
    }


    /**
     * @param array<string> $charCodes
     * @return array<Currency>
     */
    public function getValute(array $charCodes = []): array
    {
        $output = [];
        foreach ($this->getValutes() as $valute) {
            if (0 < \count($charCodes) && !\in_array($valute->getCharCode(), $charCodes)) {
                continue;
            }
            $output[] = $valute;
        }

        return $output;
    }
}
