<?php


namespace Mingalevme\Tests\HttpBuildUrl;

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    public function test()
    {
        $this->assertSame('https://github.com/mingalevme/http-build-url', build_url('github.com/mingalevme/http-build-url', [
            's' => 'https',
        ]));
    }
}
