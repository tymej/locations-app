<?php

declare(strict_types=1);

namespace Localization\Infrastructure\Http;

class Request
{
    private const UUID_REGEX = '/[0-9a-f]{8}-(?:[0-9a-f]{4}-){3}[0-9a-f]{12}/';

    private array $jsonBody;

    public function __construct(
        private string $method,
        private string $uri,
        private array|string $parsedUri,
        private ?array $headers,
        private ?string $body
    ) {
        $this->jsonBody = $this->body ? json_decode($this->body, true) : [];
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getQuery(): ?string
    {
        return $this->parsedUri['query'] ?? null;
    }

    public function getPath(): string
    {
        return $this->parsedUri['path'] ?? $this->uri;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody(): string|array
    {
        return $this->body;
    }

    public function getJsonBodyValue(string $key): mixed
    {
        return $this->jsonBody[$key] ?? null;
    }

    /**
     * @return string[]
     */
    public function filterUuid(): array
    {
        $ids = [];

        preg_match_all(self::UUID_REGEX, $this->getUri(), $ids);

        return array_filter(array_merge(...$ids));
    }

    public function findLastUuid(): ?string
    {
        $ids = $this->filterUuid();

        return end($ids) ?? null;
    }
}
