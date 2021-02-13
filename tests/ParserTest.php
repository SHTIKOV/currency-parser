<?php declare (strict_types=1);

use PHPUnit\Framework\TestCase;
use MaxCurrency\Entity\Currency;
use MaxCurrency\Exception\Loggable\NotFoundException;
use MaxCurrency\ParserAbstract;
use MaxCurrency\Parser\{
    Curl,
    File
};
use MaxCurrency\Saver\File\Config;

class ParserTest extends TestCase
{

    public function testCurlParser(): void
    {
        $config = new Config(__DIR__ . '/downloadedData.txt');

        $curl = new Curl($config);
        $this->testParser($curl);
    }

    public function testFileParser(): void
    {
        $config = new Config(__DIR__ . '/downloadedData.txt');

        $file = new File($config);
        $this->testParser($file);
    }

    private function testParser(ParserAbstract $parser): void
    {
        $currencyName = 'AUD';

        $currency = $parser->execute($currencyName);

        $this->assertInstanceOf(Currency::class, $currency);
        /** @var Currency $currency */
        $this->assertSame($currency->getCharCode(), $currencyName);

        try {
            $currency = $parser->execute('undefined');
        } catch (\Throwable $th) {
            $this->assertInstanceOf(NotFoundException::class, $th);
        }
    }
}