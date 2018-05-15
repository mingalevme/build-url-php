<?php


namespace Mingalevme\HttpBuildUrl;


class HttpBuildUrl
{
    /**
     * Build an URL
     *
     * @param string|array $url Base url or parts of the url (aliases is not supported), to build from scratch use any falsy value, e.g. [], null or ''
     * @param array $replacement [optional] Associative array like parse_url() returns
     * @param array &$newUrlParts [optional] If set, it will be filled with the parts of the composed url like parse_url() would return
     * @return string The new URL string
     */
    public static function build($url, $replacement=[], &$newUrlParts=null)
    {
        /**
         * "p" is not used to not confusing between port, path, password;
         * use fully qualified name
         */
        $aliases = [
            'u' => 'user',
            's' => 'scheme',
            'h' => 'host',
            'q' => 'query',
            'f' => 'fragment',
        ];

        /**
         * Resolve aliases
         */
        foreach ($replacement as $k => $value) {
            if (isset($aliases[strtolower($k)])) {
                $key = $aliases[strtolower($k)];
                if ($k === strtoupper($k)) {
                    $replacement[strtoupper($key)] = $value;
                } else {
                    $replacement[$key] = $value;
                }
                unset($replacement[$k]);
            }
        }

        /**
         * Parse the original URL
         */
        $parts = is_array($url)
            ? $url
            : parse_url(trim($url));

        $isSchemaless = is_string($url) && isset($parts['scheme']) === false && substr($url, 0, 2) === '//';

        foreach ($replacement as $key => $value) {

            if ($value === null) {

                unset($parts[$key]);

            } elseif ($key === strtoupper($key) || isset($parts[$key]) == false) {

                $parts[strtolower($key)] = $replacement[$key];

            } elseif ($key == 'query') {

                /**
                 * Merging query args
                 */

                $baseQuery = [];

                parse_str($parts['query'], $baseQuery);

                if (is_array($value)) {
                    $query = $value;
                } else {
                    $query = array();
                    parse_str($value, $query);
                }

                $parts['query'] = array_merge($baseQuery, $query);

            }

        }

        if (isset($parts['query']) && is_array($parts['query'])) {
            $parts['query'] = http_build_query($parts['query']);
        }

        $newUrlParts = $parts;

        return
            ((isset($parts['scheme'])) ? $parts['scheme'] . '://' : ($isSchemaless ? '//' : ''))
            .((isset($parts['user'])) ? $parts['user'] . ((isset($parts['pass'])) ? ':' . $parts['pass'] : '') .'@' : '')
            .((isset($parts['host'])) ? $parts['host'] : '')
            .((isset($parts['port'])) ? ':' . $parts['port'] : '')
            .((isset($parts['path'])) ? $parts['path'] : '')
            .((isset($parts['query']) && $parts['query']) ? '?' . $parts['query'] : '')
            .((isset($parts['fragment'])) ? '#' . $parts['fragment'] : '')
        ;
    }
}

function build_url($url, $replacement=[], &$newUrlParts=null)
{
    return HttpBuildUrl::build($url, $replacement, $newUrlParts);
}
