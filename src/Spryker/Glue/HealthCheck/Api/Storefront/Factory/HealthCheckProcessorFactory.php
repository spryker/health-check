<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\HealthCheck\Api\Storefront\Factory;

use Spryker\Glue\HealthCheck\HealthCheckConfig;
use Spryker\Service\Container\Attributes\Plugins;
use Spryker\Shared\HealthCheck\ChainFilter\ChainFilterInterface;
use Spryker\Shared\HealthCheck\ChainFilter\Filter\ServiceNameFilter;
use Spryker\Shared\HealthCheck\ChainFilter\FilterInterface;
use Spryker\Shared\HealthCheck\ChainFilter\ServiceChainFilter;
use Spryker\Shared\HealthCheck\Processor\HealthCheckProcessor;
use Spryker\Shared\HealthCheck\Processor\HealthCheckProcessorInterface;
use Spryker\Shared\HealthCheck\Processor\ResponseProcessor;
use Spryker\Shared\HealthCheck\Processor\ResponseProcessorInterface;
use Spryker\Shared\HealthCheck\Validator\ServiceNameValidator;
use Spryker\Shared\HealthCheck\Validator\ValidatorInterface;

class HealthCheckProcessorFactory
{
    /**
     * @param array<\Spryker\Shared\HealthCheckExtension\Dependency\Plugin\HealthCheckPluginInterface> $healthCheckPlugins
     */
    public function __construct(
        protected HealthCheckConfig $healthCheckConfig,
        #[Plugins(dependencyProviderMethod: 'getHealthCheckPlugins')]
        protected array $healthCheckPlugins = [],
    ) {
    }

    public function createHealthCheckProcessor(): HealthCheckProcessorInterface
    {
        return new HealthCheckProcessor(
            $this->createServiceNameValidator(),
            $this->createServiceChainFilter(),
            $this->createResponseProcessor(),
            $this->healthCheckPlugins,
        );
    }

    public function createServiceNameValidator(): ValidatorInterface
    {
        return new ServiceNameValidator();
    }

    public function createServiceChainFilter(): ChainFilterInterface
    {
        return (new ServiceChainFilter())->addFilter($this->createServiceNameFilter());
    }

    public function createServiceNameFilter(): FilterInterface
    {
        return new ServiceNameFilter();
    }

    public function createResponseProcessor(): ResponseProcessorInterface
    {
        return new ResponseProcessor($this->healthCheckConfig->isHealthCheckEnabled());
    }
}
