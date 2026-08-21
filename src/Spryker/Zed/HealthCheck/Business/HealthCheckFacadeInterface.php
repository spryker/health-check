<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\HealthCheck\Business;

use Generated\Shared\Transfer\HealthCheckResponseTransfer;

interface HealthCheckFacadeInterface
{
    /**
     * Specification:
     * - Performs health checks based on plugin stack.
     *
     * @api
     */
    public function executeHealthCheck(?string $requestedServices = null): HealthCheckResponseTransfer;
}
