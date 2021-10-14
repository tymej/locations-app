<?php

return [
    ['/api/addresses', \Localization\Entry\Controller\AddressController::class, 'findAllAction', 'GET'],
    ['/api/addresses/%s', \Localization\Entry\Controller\AddressController::class, 'findAction', 'GET'],
    ['/api/addresses', \Localization\Entry\Controller\AddressController::class, 'createAction', 'POST'],
    ['/api/addresses/%s', \Localization\Entry\Controller\AddressController::class, 'editAction', 'PUT'],
    ['/api/addresses/%s', \Localization\Entry\Controller\AddressController::class, 'removeAction', 'DELETE'],
    ['/api/addresses/%s/calculate/distance-to', \Localization\Entry\Controller\AddressController::class, 'calculateDistanceAction', 'POST']
];
