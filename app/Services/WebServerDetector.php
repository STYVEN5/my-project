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

    public function detectServerHeader(string $url): ?string
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_NOBODY         => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 3,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        if (!$response) {
            return null;
        }

        $found = null;
        foreach (explode("\n", $response) as $line) {
            if (preg_match('/^Server:\s*(.+)$/i', $line, $m)) {
                $found = trim($m[1]);
            }
        }

        return $found;
    }
}
