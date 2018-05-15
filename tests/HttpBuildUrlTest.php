<?php

namespace Mingalevme\Tests\HttpBuildUrl;

use Mingalevme\HttpBuildUrl\HttpBuildUrl;
use PHPUnit\Framework\TestCase;

class HttpBuildUrlTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testBuild($expected, $url, $params)
    {
        $this->assertEquals($expected, HttpBuildUrl::build($url, $params));
    }

    public function dataProvider()
    {
        return [
            [
                'https://github.com/mingalevme/http_build_url#github',
                [
                    'scheme' => 'https',
                    'path' => '/mingalevme/http_build_url',
                    'host' => 'github.com',
                ],
                [
                    'f' => 'github',
                ],
            ],
            [
                'https://github.com/mingalevme/http_build_url',
                '//github.com/mingalevme/http_build_url',
                [
                    's' => 'https',
                ],
            ],
            [
                '//github.com/mingalevme/http_build_url',
                '//github.com',
                [
                    'path' => '/mingalevme/http_build_url',
                ],
            ],
            [
                'https://github.com/mingalevme/http_build_url',
                '/mingalevme/http_build_url',
                [
                    's' => 'https',
                    'h' => 'github.com'
                ],
            ],
            [
                'https://github.com/mingalevme/http_build_url',
                '//github.com/mingalevme/http_build_url',
                [
                    's' => 'https',
                    'h' => 'bitbucket.com'
                ],
            ],
            [
                'https://github.com/mingalevme/http_build_url',
                'http://bitbucket.com/mingalevme/http_build_url',
                [
                    'S' => 'https',
                    'H' => 'github.com'
                ],
            ],
            [
                'https://username:password@github.com/mingalevme/http_build_url',
                'https://github.com/mingalevme/http_build_url',
                [
                    'user' => 'username',
                    'pass' => 'password'
                ],
            ],
            [
                'https://github.com/mingalevme/http_build_url?foo=bar&bar=foo',
                    'https://github.com/mingalevme/http_build_url',
                [
                    'q' => 'foo=bar&bar=foo',
                ],
            ],
            [
                'https://github.com/mingalevme/http_build_url?boo=far&far=boo&foo=bar&bar=foo',
                'https://github.com/mingalevme/http_build_url?boo=far&far=boo',
                [
                    'q' => 'foo=bar&bar=foo',
                ],
            ],
            [
                'https://github.com/mingalevme/http_build_url?foo=bar&bar=foo',
                'https://github.com/mingalevme/http_build_url?boo=far&far=boo',
                [
                    'Q' => 'foo=bar&bar=foo',
                ],
            ],
            [
                'https://github.com/mingalevme/http_build_url?boo=far&far=boo&foo=bar&bar=foo',
                'https://github.com/mingalevme/http_build_url?boo=far&far=boo',
                [
                    'q' => [
                        'foo' => 'bar',
                        'bar' => 'foo',
                    ],
                ],
            ],
            [
                'https://github.com/mingalevme/http_build_url?foo=bar&bar=foo',
                'https://github.com/mingalevme/http_build_url?boo=far&far=boo',
                [
                    'Q' => [
                        'foo' => 'bar',
                        'bar' => 'foo',
                    ],
                ],
            ],
            [
                'https://github.com/mingalevme/http_build_url#github',
                'http://bitbucket.com/mingalevme/http_build_url',
                [
                    'S' => 'https',
                    'H' => 'github.com',
                    'path' => 'mingalevme/http_build_url',
                    'F' => 'github',
                ],
            ],
        ];
    }
}
