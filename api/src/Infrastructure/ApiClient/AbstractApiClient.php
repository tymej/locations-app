<?php

declare(strict_types=1);

namespace Localization\Infrastructure\ApiClient;

class AbstractApiClient
{
    protected function sendGetJsonRequest(string $uri, array $headers = []): ?array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($headers) {
            curl_setopt($ch, CURLOPT_HEADER, $headers);
        }
        $response = curl_exec($ch);
        curl_close($ch);

        $jsonResponse = json_decode($response, true);

        return $jsonResponse ?: null;
    }
}
