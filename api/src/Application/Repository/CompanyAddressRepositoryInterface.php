<?php

namespace Localization\Application\Repository;

use Localization\Application\Entity\CompanyAddress;

interface CompanyAddressRepositoryInterface
{
    public function find(string $id): ?CompanyAddress;

    /**
     * @return CompanyAddress[]
     */
    public function findAll(): array;

    public function insert(CompanyAddress $companyAddress): void;

    public function update(CompanyAddress $companyAddress): void;

    public function remove(CompanyAddress $companyAddress): void;
}