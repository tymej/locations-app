<?php

declare(strict_types=1);

namespace Localization\Entry\Controller;

use Localization\Application\Command\CalculateDistance;
use Localization\Application\Command\CreateCompanyAddress;
use Localization\Application\Command\EditCompanyAddress;
use Localization\Application\Command\RemoveCompanyAddress;
use Localization\Application\Repository\CompanyAddressRepositoryInterface;
use Localization\Entry\Controller\Validator\LocationRequestValidator;
use Localization\Infrastructure\Http\Request;
use Localization\Infrastructure\Http\Response;
use Localization\Infrastructure\Uuid;

class AddressController
{
    public function __construct(
        private LocationRequestValidator $locationRequestValidator,
        private CompanyAddressRepositoryInterface $addressRepository,
        private CreateCompanyAddress $createCompanyAddress,
        private EditCompanyAddress $editCompanyAddress,
        private RemoveCompanyAddress $removeCompanyAddress,
        private CalculateDistance $calculateDistance
    ) {
    }

    public function findAllAction(Request $request): Response
    {
        return new Response($this->addressRepository->findAll());
    }

    public function findAction(Request $request): Response
    {
        $id = $request->findLastUuid();

        $address = $this->addressRepository->find($id);

        if (!$address) {
            return Response::createNotFound(sprintf('Location %s does not exist', $id));
        }

        return new Response($address);
    }

    public function createAction(Request $request): Response
    {
        $id = Uuid::generate();

        if (!$this->locationRequestValidator->isValid($request)) {
            return Response::createBadRequest('Invalid request params');
        }

        $this->createCompanyAddress->handle(
            $id,
            $request->getJsonBodyValue('street'),
            $request->getJsonBodyValue('city')
        );

        return new Response($this->addressRepository->find($id), Response::HTTP_CREATED);
    }

    public function editAction(Request $request): Response
    {
        $id = $request->findLastUuid();

        if (!$this->locationRequestValidator->isValid($request) || !$this->addressRepository->find($id)) {
            return Response::createBadRequest('Invalid request params');
        }

        $this->editCompanyAddress->handle(
            $id,
            $request->getJsonBodyValue('street'),
            $request->getJsonBodyValue('city')
        );

        return new Response();
    }

    public function removeAction(Request $request): Response
    {
        $id = $request->findLastUuid();

        $this->removeCompanyAddress->handle($id);

        return new Response(['Removed']);
    }

    public function calculateDistanceAction(Request $request): Response
    {
        $companyAddressId = $request->findLastUuid();
        $companyAddress = $this->addressRepository->find($companyAddressId);

        if (!$this->locationRequestValidator->isValid($request) || !$companyAddress) {
            return Response::createBadRequest('Invalid request params');
        }

        $destinationStreet = $request->getJsonBodyValue('street');
        $destinationCity = $request->getJsonBodyValue('city');

        if (!$destinationStreet || !$destinationCity) {
            return Response::createBadRequest('Invalid request parameters');
        }

        return new Response(
            [
                'kilometers' => $this->calculateDistance->handle($companyAddress, $destinationStreet, $destinationCity)
            ]
        );
    }
}
