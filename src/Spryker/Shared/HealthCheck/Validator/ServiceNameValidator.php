<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\HealthCheck\Validator;

use Generated\Shared\Transfer\HealthCheckRequestTransfer;

class ServiceNameValidator implements ValidatorInterface
{
    /**
     * @param \Spryker\Shared\HealthCheckExtension\Dependency\Plugin\HealthCheckPluginInterface[] $healthCheckPlugins
     * @param \Generated\Shared\Transfer\HealthCheckRequestTransfer $healthCheckRequestTransfer
     *
     * @return bool
     */
    public function validate(array $healthCheckPlugins, HealthCheckRequestTransfer $healthCheckRequestTransfer): bool
    {
        $requestedServices = $healthCheckRequestTransfer->getRequestedServices();

        if (count($requestedServices) === 0) {
            return true;
        }

        foreach ($requestedServices as $requestedService) {
            if (!in_array($requestedService, array_keys($healthCheckPlugins))) {
                return false;
            }
        }

        return true;
    }
}
