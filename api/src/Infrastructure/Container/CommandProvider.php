<?php

declare(strict_types=1);

namespace Localization\Infrastructure\Container;

use Localization\Application\Api\LocationsClientInterface;
use Localization\Application\Command\CalculateDistance;
use Localization\Application\Command\CreateCompanyAddress;
use Localization\Application\Command\EditCompanyAddress;
use Localization\Application\Command\RemoveCompanyAddress;
use Localization\Application\Repository\CompanyAddressRepositoryInterface;
use Localization\Infrastructure\ServiceContainer;

class CommandProvider extends AbstractContainer
{
    public function loadInstances(): void
    {
        /** @var CompanyAddressRepositoryInterface $companyAddressRepository */
        $companyAddressRepository = ServiceContainer::getInstance(CompanyAddressRepositoryInterface::class);
        /** @var LocationsClientInterface $locationsClient */
        $locationsClient = ServiceContainer::getInstance(LocationsClientInterface::class);

        $this->setInstances(
            [
                CreateCompanyAddress::class => new CreateCompanyAddress($companyAddressRepository),
                EditCompanyAddress::class => new EditCompanyAddress($companyAddressRepository),
                RemoveCompanyAddress::class => new RemoveCompanyAddress($companyAddressRepository),
                CalculateDistance::class => new CalculateDistance($locationsClient),
            ]
        );
    }
}
