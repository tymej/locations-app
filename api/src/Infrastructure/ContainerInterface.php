<?php


namespace Localization\Infrastructure;


interface ContainerInterface
{
    public function hasInstance(string $id): bool;

    public function getInstance(string $id): object;
}