<?php

namespace Localization\Infrastructure\Http;

use JsonSerializable;

class Response
{
    private const NOT_FOUND_DEFAULT_MESSAGE = 'Not found';
    private const HEADER_JSON_RESPONSE = 'Content-Type: application/json; charset=UTF-8';
    private const HEADER_HTTP_NOT_FOUND = 'HTTP/1.0 404 Not Found';

    public const HTTP_OK = 200;
    public const HTTP_CREATED = 201;
    public const HTTP_BAD_REQUEST = 400;
    public const HTTP_NOT_FOUND = 404;

    const HEADER_ALLOW_ORIGIN = "Access-Control-Allow-Origin: *";
    const H = "Access-Control-Allow-Headers: *";

    public function __construct(
        private JsonSerializable|array|string|null $content = '',
        private int $httpCode = self::HTTP_OK
    )
    {
    }

    public static function createNotFound(string $message = self::NOT_FOUND_DEFAULT_MESSAGE): self
    {
        return new self(['message' => $message], self::HTTP_NOT_FOUND);
    }

    public static function createBadRequest(string $message)
    {
        return new self(['message' => $message], self::HTTP_BAD_REQUEST);
    }

    public function resolve(): string
    {
        header(self::HEADER_JSON_RESPONSE);
        header(self::HEADER_ALLOW_ORIGIN);
        header(self::H);
        http_response_code($this->httpCode);

        return json_encode($this->content ?: []);
    }
}