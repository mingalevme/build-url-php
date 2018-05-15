# http_build_url
Advanced version of http_build_url

# Travis CI
[![Build Status](https://travis-ci.org/mingalevme/http_build_url.svg?branch=master)](https://travis-ci.org/mingalevme/http_build_url)

# Installation

1. ```composer require mingalevme/http_build_url```.

2. Now you are able to use the tool:
```php
<?php

echo build_url('//github.com/mingalevme/http_build_url', [
    's' => 'https', // s (scheme): set scheme only if not presented
]); // https://github.com/mingalevme/http_build_url

echo build_url('http://github.com/mingalevme/http_build_url', [
    'S' => 'https', // S (SCHEME): force set scheme
]); // https://github.com/mingalevme/http_build_url

echo build_url('https://github.com/mingalevme/http_build_url', [
    'h' => 'bitbucket.org', // h (host): set host only if not presented
]); // https://github.com/mingalevme/http_build_url

echo build_url('https://github.com/mingalevme/http_build_url', [
    'H' => 'bitbucket.org', // H (HOST): force set host
]); // https://github.com/mingalevme/http_build_url
```

# Usage

```php
/**
 * Build an URL
 *
 * @param string|array $url Base url or parts of the url (aliases is not supported), to build from scratch use any falsy value, e.g. [], null or ''
 * @param array $replacement [optional] Associative array like parse_url() returns
 * @param array &$newUrlParts [optional] If set, it will be filled with the parts of the composed url like parse_url() would return
 * @return string The new URL string
 */
Mingalevme\HttpBuildUrl\HttpBuildUrl::build(string|array $url, array $replacement=[], array &$newUrlParts=null)
```

# Aliases
```php
/**
 * "p" is not used to not confusing between port, path, password;
 * use fully qualified name
 */
[
    'u' => 'user',
    's' => 'scheme',
    'h' => 'host',
    'q' => 'query',
    'f' => 'fragment',
]
```
