<?php

declare(strict_types=1);

namespace Localization\Infrastructure;

interface ContainerInterface
{
    public function hasInstance(string $id): bool;

    public function getInstance(string $id): object;
}
