<?php

namespace App\Services;

class WebServerDetector
{
    public function resolveIp(string $url): ?string
    {
        $host = parse_url($url, PHP_URL_HOST);

        if (!$host) {
            return null;
        }

        $ip = gethostbyname($host);

        return ($ip !== $host) ? $ip : null;
    }

}
