<?php

declare(strict_types=1);

namespace Localization\Infrastructure\Container;

use Localization\Application\Repository\CompanyAddressRepositoryInterface;
use Localization\Infrastructure\Mapper\AddressMapper;
use Localization\Infrastructure\Repository\CompanyAddressRepository;
use Localization\Infrastructure\ServiceContainer;

class RepositoryProvider extends AbstractContainer
{
    public function loadInstances(): void
    {
        /** @var AddressMapper $addressMapper */
        $addressMapper = ServiceContainer::getInstance(AddressMapper::class);

        $this->setInstances(
            [
                CompanyAddressRepositoryInterface::class => new CompanyAddressRepository($addressMapper),
            ]
        );
    }
}
