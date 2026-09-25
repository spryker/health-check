<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\HealthCheck\Processor;

use Generated\Shared\Transfer\HealthCheckResponseTransfer;

interface ResponseProcessorInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\HealthCheckServiceResponseTransfer> $healthCheckServiceResponseTransfers
     */
    public function processOutput(array $healthCheckServiceResponseTransfers): HealthCheckResponseTransfer;

    public function processNonExistingServiceName(): HealthCheckResponseTransfer;

    public function isHealthCheckEnabled(): bool;

    public function processDisabled(): HealthCheckResponseTransfer;
}
