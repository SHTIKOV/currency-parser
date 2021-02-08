<?php declare (strict_types=1);

use PHPUnit\Framework\TestCase;

class KernelTest extends TestCase
{

    public function testKernelCurl(): void
    {
        $kernel = new MaxCurrency\Kernel();
        $this->assertSame($kernel->curl, \Curl\Curl::class);
    }
}