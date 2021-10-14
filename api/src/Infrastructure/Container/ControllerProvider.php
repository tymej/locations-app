<?php

namespace Localization\Infrastructure\Container;

use Localization\Application\Command\CalculateDistance;
use Localization\Application\Command\CreateCompanyAddress;
use Localization\Application\Command\EditCompanyAddress;
use Localization\Application\Command\RemoveCompanyAddress;
use Localization\Application\Repository\CompanyAddressRepositoryInterface;
use Localization\Entry\Controller\AddressController;
use Localization\Entry\Controller\Validator\LocationRequestValidator;
use Localization\Infrastructure\ServiceContainer;

class ControllerProvider extends AbstractContainer
{
    public function loadInstances(): void
    {
        /** @var CompanyAddressRepositoryInterface $companyRepository */
        $companyRepository = ServiceContainer::getInstance(CompanyAddressRepositoryInterface::class);
        /** @var CreateCompanyAddress $createCompanyAddress */
        $createCompanyAddress = ServiceContainer::getInstance(CreateCompanyAddress::class);
        /** @var EditCompanyAddress $editCompanyAddress */
        $editCompanyAddress = ServiceContainer::getInstance(EditCompanyAddress::class);
        /** @var RemoveCompanyAddress $removeCompanyAddress */
        $removeCompanyAddress = ServiceContainer::getInstance(RemoveCompanyAddress::class);
        /** @var CalculateDistance $calculateDistance */
        $calculateDistance = ServiceContainer::getInstance(CalculateDistance::class);

        $this->setInstances(
            [
                AddressController::class => new AddressController(
                    new LocationRequestValidator(),
                    $companyRepository,
                    $createCompanyAddress,
                    $editCompanyAddress,
                    $removeCompanyAddress,
                    $calculateDistance
                )
            ]
        );
    }
}
