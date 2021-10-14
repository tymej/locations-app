<?php

declare(strict_types=1);

namespace Localization\Application\Command;

use Localization\Application\Entity\CompanyAddress;
use Localization\Application\Repository\CompanyAddressRepositoryInterface;

class CreateCompanyAddress
{
    public function __construct(
        private CompanyAddressRepositoryInterface $companyAddressRepository
    ) {
    }

    public function handle(string $id, string $street, string $city): void
    {
        $companyAddress = new CompanyAddress($id, $street, $city);

        $this->companyAddressRepository->insert($companyAddress);
    }
}
