<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\HealthCheck;

use Spryker\Glue\Kernel\AbstractBundleConfig;

/**
 * @method \Spryker\Shared\HealthCheck\HealthCheckConfig getSharedConfig()
 */
class HealthCheckConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @var string
     */
    public const RESOURCE_HEALTH_CHECK = 'health-check';

    /**
     * @api
     *
     * @var string
     */
    public const CONTROLLER_HEALTH_CHECK = 'health-check-resource';

    /**
     * @api
     *
     * @return bool
     */
    public function isHealthCheckEnabled(): bool
    {
        return $this->getSharedConfig()->isHealthCheckEnabled();
    }
}
