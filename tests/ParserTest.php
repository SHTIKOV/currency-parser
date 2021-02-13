<?php declare (strict_types=1);

use PHPUnit\Framework\TestCase;
use MaxCurrency\Exception\Loggable\NotFoundException;
use MaxCurrency\ParserAbstract;
use MaxCurrency\Parser\{
    Curl,
    File
};
use MaxCurrency\Saver\File as FileSaver;

/**
 * Simple test of parser work
 * 
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
class ParserTest extends TestCase
{
    const PATH = __DIR__ . '/downloadedData.txt';

    public function testCurlParser(): void
    {
        $config = new FileSaver(ParserTest::PATH);

        $curl = new Curl($config);
        $this->testParser($curl);
    }

    public function testFileParser(): void
    {
        $config = new FileSaver(ParserTest::PATH);

        $file = new File($config);
        $this->testParser($file);
    }

    private function testParser(ParserAbstract $parser): void
    {
        $parser->execute(['EUR', 'USD']);

        $stringData = file_get_contents(ParserTest::PATH, true);
        $arrayData = \explode(PHP_EOL, $stringData);
        
        $this->assertTrue(1 < count($arrayData), 'Expects more strings then 1');

        try {
            $parser->execute(['undefined']);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(NotFoundException::class, $th);
        }
    }
}