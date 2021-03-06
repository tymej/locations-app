<?php

declare(strict_types=1);

namespace Localization\Application\Command;

use Localization\Application\Repository\CompanyAddressRepositoryInterface;
use RuntimeException;

class RemoveCompanyAddress
{
    public function __construct(
        private CompanyAddressRepositoryInterface $companyAddressRepository
    ) {
    }

    public function handle(string $id): void
    {
        $companyAddress = $this->companyAddressRepository->find($id);

        if (!$companyAddress) {
            throw new RuntimeException(sprintf('Company address %s does not exist', $id));
        }

        $this->companyAddressRepository->remove($companyAddress);
    }
}
