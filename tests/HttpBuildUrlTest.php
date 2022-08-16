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
                'https://github.com/mingalevme/http-build-url#github',
                [
                    'scheme' => 'https',
                    'path' => '/mingalevme/http-build-url',
                    'host' => 'github.com',
                ],
                [
                    'f' => 'github',
                ],
            ],
            [
                'https://github.com/mingalevme/http-build-url',
                '//github.com/mingalevme/http-build-url',
                [
                    's' => 'https',
                ],
            ],
            [
                '//github.com/mingalevme/http-build-url',
                '//github.com',
                [
                    'path' => '/mingalevme/http-build-url',
                ],
            ],
            [
                'https://github.com/mingalevme/http-build-url',
                '/mingalevme/http-build-url',
                [
                    's' => 'https',
                    'h' => 'github.com'
                ],
            ],
            [
                'https://github.com/mingalevme/http-build-url',
                '//github.com/mingalevme/http-build-url',
                [
                    's' => 'https',
                    'h' => 'bitbucket.com'
                ],
            ],
            [
                'https://github.com/mingalevme/http-build-url',
                'http://bitbucket.com/mingalevme/http-build-url',
                [
                    'S' => 'https',
                    'H' => 'github.com'
                ],
            ],
            [
                'https://username:password@github.com/mingalevme/http-build-url',
                'https://github.com/mingalevme/http-build-url',
                [
                    'user' => 'username',
                    'pass' => 'password'
                ],
            ],
            [
                'https://github.com/mingalevme/http-build-url?foo=bar&bar=foo',
                    'https://github.com/mingalevme/http-build-url',
                [
                    'q' => 'foo=bar&bar=foo',
                ],
            ],
            [
                'https://github.com/mingalevme/http-build-url?boo=far&far=boo&foo=bar&bar=foo',
                'https://github.com/mingalevme/http-build-url?boo=far&far=boo',
                [
                    'q' => 'foo=bar&bar=foo',
                ],
            ],
            [
                'https://github.com/mingalevme/http-build-url?foo=bar&bar=foo',
                'https://github.com/mingalevme/http-build-url?boo=far&far=boo',
                [
                    'Q' => 'foo=bar&bar=foo',
                ],
            ],
            [
                'https://github.com/mingalevme/http-build-url?boo=far&far=boo&foo=bar&bar=foo',
                'https://github.com/mingalevme/http-build-url?boo=far&far=boo',
                [
                    'q' => [
                        'foo' => 'bar',
                        'bar' => 'foo',
                    ],
                ],
            ],
            [
                'https://github.com/mingalevme/http-build-url?foo=bar&bar=foo',
                'https://github.com/mingalevme/http-build-url?boo=far&far=boo',
                [
                    'Q' => [
                        'foo' => 'bar',
                        'bar' => 'foo',
                    ],
                ],
            ],
            [
                'https://github.com/mingalevme/http-build-url#github',
                'http://bitbucket.com/mingalevme/http-build-url',
                [
                    'S' => 'https',
                    'H' => 'github.com',
                    'path' => 'mingalevme/http-build-url',
                    'F' => 'github',
                ],
            ],
            [
                'github.com/mingalevme/http-build-url',
                'https://github.com/mingalevme/http-build-url',
                [
                    's' => null,
                ],
            ],
        ];
    }

    public function testHelper()
    {
        $this->assertSame('https://github.com/mingalevme/http-build-url', \Mingalevme\HttpBuildUrl\build_url('github.com/mingalevme/http-build-url', [
            's' => 'https',
        ]));
    }

    # https://github.com/php/php-src/issues/7890
    public function testIssues7890()
    {
        if (version_compare(PHP_VERSION, '7.4.0', '<')) {
            $this->assertSame('//www.example.com/ddd:65535/', HttpBuildUrl::build('//www.example.com/ddd:65535/', [
                's' => 'https',
            ]));
        } else {
            $this->assertSame('https://www.example.com/ddd:65535/', HttpBuildUrl::build('//www.example.com/ddd:65535/', [
                's' => 'https',
            ]));
        }
    }
}
