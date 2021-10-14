<?php

namespace Localization\Infrastructure;

use Localization\Infrastructure\Http\Request;

class RequestFactory
{
    public static function createFromGlobals(array $serverParams, array $headers, ?string $body): Request
    {
        return new Request(
            $serverParams['REQUEST_METHOD'],
            $serverParams['REQUEST_URI'],
            parse_url($serverParams['REQUEST_URI']),
            $headers,
            $body
        );
    }
}