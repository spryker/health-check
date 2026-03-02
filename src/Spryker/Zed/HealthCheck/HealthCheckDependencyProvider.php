<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\HealthCheck;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \Spryker\Zed\HealthCheck\HealthCheckConfig getConfig()
 */
class HealthCheckDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_HEALTH_CHECK = 'PLUGINS_HEALTH_CHECK';

    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addHealthCheckPlugins($container);

        return $container;
    }

    protected function addHealthCheckPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_HEALTH_CHECK, function (Container $container) {
            return $this->getHealthCheckPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Shared\HealthCheckExtension\Dependency\Plugin\HealthCheckPluginInterface>
     */
    protected function getHealthCheckPlugins(): array
    {
        return [];
    }
}
