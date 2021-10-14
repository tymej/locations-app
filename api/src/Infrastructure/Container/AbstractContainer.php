<?php

declare(strict_types=1);

namespace Localization\Infrastructure\Container;

use Localization\Infrastructure\ContainerInterface;

abstract class AbstractContainer implements ContainerInterface
{
    private array $instances = [];

    abstract public function loadInstances(): void;

    protected function setInstances(array $instances): void
    {
        $this->instances = $instances;
    }

    public function hasInstance(string $id): bool
    {
        return array_key_exists($id, $this->instances);
    }

    public function getInstance(string $id): object
    {
        if (!$this->hasInstance($id)) {
            throw new \RuntimeException(sprintf('Dependency %s does not exist', $id));
        }

        return $this->instances[$id];
    }
}
