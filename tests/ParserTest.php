<?php declare (strict_types=1);

use PHPUnit\Framework\TestCase;
use MaxCurrency\Entity\Currency;
use MaxCurrency\Exception\Loggable\NotFoundException;
use MaxCurrency\ParserAbstract;
use MaxCurrency\Parser\{
    Curl,
    File
};

class ParserTest extends TestCase
{

    public function testCurlParser(): void
    {
        $this->testParser(new Curl());
    }

    public function testFileParser(): void
    {
        $this->testParser(new File());
    }

    private function testParser(ParserAbstract $parser): void
    {
        $currencyName = 'AUD';
        $currency = $parser->getCurrencyData($currencyName);

        $this->assertInstanceOf(Currency::class, $currency);
        $this->assertSame($currency->getCharCode(), $currencyName);

        try {
            $currency = $parser->getCurrencyData('undefined');
        } catch (\Throwable $th) {
            $this->assertInstanceOf(NotFoundException::class, $th);
        }
    }
}