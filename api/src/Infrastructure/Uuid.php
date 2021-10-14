<?php

declare(strict_types=1);

namespace Localization\Infrastructure;

class Uuid
{
    public static function generate(): string
    {
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
    }
}
