<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\HealthCheck\Communication\Controller;

use Generated\Shared\Transfer\HealthCheckRequestTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\HealthCheck\Communication\HealthCheckCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    protected const KEY_SERVICES = 'services';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request): JsonResponse
    {
        $requestedServices = $request->get(static::KEY_SERVICES);

        $healthCheckRequestTransfer = (new HealthCheckRequestTransfer())
            ->setServices($requestedServices);

        $healthCheckResponseTransfer = $this->getFactory()
            ->getHealthCheckService()
            ->checkZedHealthCheck($healthCheckRequestTransfer);

        return new JsonResponse($healthCheckResponseTransfer->toArray());
    }
}
