<?php

namespace Localization\Application\Command;

use Localization\Application\Repository\CompanyAddressRepositoryInterface;

class EditCompanyAddress
{
    public function __construct(
        private CompanyAddressRepositoryInterface $companyAddressRepository
    )
    {
    }

    public function handle(string $id, string $street, string $city): void
    {
        $companyAddress = $this->companyAddressRepository->find($id);

        if (!$companyAddress) {
            throw new \RuntimeException(sprintf('Company address %s does not exist', $id));
        }

        $companyAddress->street = $street;
        $companyAddress->city = $city;

        $this->companyAddressRepository->update($companyAddress);
    }
}
