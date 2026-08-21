<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\HealthCheck\ChainFilter;

use Generated\Shared\Transfer\HealthCheckRequestTransfer;

class ServiceChainFilter implements ChainFilterInterface, ChainFilterAddInterface
{
    /**
     * @var array<\Spryker\Shared\HealthCheck\ChainFilter\FilterInterface>
     */
    protected $filters = [];

    /**
     * @return $this
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * @param array<\Spryker\Shared\HealthCheckExtension\Dependency\Plugin\HealthCheckPluginInterface> $healthCheckPlugins
     *
     * @return array<\Spryker\Shared\HealthCheckExtension\Dependency\Plugin\HealthCheckPluginInterface>
     */
    public function filter(array $healthCheckPlugins, HealthCheckRequestTransfer $healthCheckRequestTransfer): array
    {
        foreach ($this->filters as $filter) {
            $healthCheckPlugins = $filter->filter($healthCheckPlugins, $healthCheckRequestTransfer);
        }

        return $healthCheckPlugins;
    }
}
