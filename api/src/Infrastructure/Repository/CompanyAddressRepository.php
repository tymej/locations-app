<?php

namespace Localization\Infrastructure\Repository;

use Localization\Application\Entity\CompanyAddress;
use Localization\Application\Repository\CompanyAddressRepositoryInterface;
use Localization\Infrastructure\Mapper\AddressMapper;

class CompanyAddressRepository implements CompanyAddressRepositoryInterface
{
    public function __construct(private AddressMapper $addressMapper)
    {
    }

    public function find(string $id): ?CompanyAddress
    {
        return $this->addressMapper->find($id);
    }

    public function findAll(): array
    {
        return $this->addressMapper->findAll();
    }

    public function insert(CompanyAddress $companyAddress): void
    {
        $this->addressMapper->insert($companyAddress);
    }

    public function update(CompanyAddress $companyAddress): void
    {
        $this->addressMapper->update($companyAddress);
    }

    public function remove(CompanyAddress $companyAddress): void
    {
        $this->addressMapper->remove($companyAddress->id);
    }
}