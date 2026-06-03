<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\HealthCheck\Api\Storefront\Reader;

use Generated\Shared\Transfer\HealthCheckResponseTransfer;
use Spryker\Glue\HealthCheck\Api\Storefront\Factory\HealthCheckProcessorFactory;

class HealthCheckReader implements HealthCheckReaderInterface
{
    public function __construct(
        protected HealthCheckProcessorFactory $healthCheckProcessorFactory,
    ) {
    }

    public function processHealthCheck(?string $requestedServices): HealthCheckResponseTransfer
    {
        return $this->healthCheckProcessorFactory
            ->createHealthCheckProcessor()
            ->process($requestedServices);
    }
}
