<?php

use Mingalevme\HttpBuildUrl\HttpBuildUrl;

if (! function_exists('build_url')) {
    /**
     * Build an URL
     *
     * @param $url Base url, to build from scratch use any falsy value, e.g. null or ''
     * @param array $replacement [optional] Associative array like parse_url() returns
     * @param array &$newUrlParts [optional] If set, it will be filled with the parts of the composed url like parse_url() would return
     * @return string The new URL string
     */
    function build_url($url, $replacement=[], &$newUrlParts=null)
    {
        return HttpBuildUrl::build($url, $replacement, $newUrlParts);
    }
}
