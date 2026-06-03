<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\HealthCheck\Api\Storefront\Provider;

use Generated\Api\Storefront\HealthCheckStorefrontResource;
use Spryker\ApiPlatform\State\Provider\AbstractStorefrontProvider;
use Spryker\Glue\HealthCheck\Api\Storefront\Reader\HealthCheckReaderInterface;
use Spryker\Service\Serializer\SerializerServiceInterface;

/**
 * The HTTP status code is dynamic (200/400/403/503) but the body shape is identical for all four,
 * so the desired status is communicated via a request attribute consumed by
 * {@see \Spryker\Glue\HealthCheck\Api\Storefront\EventSubscriber\HealthCheckResponseStatusSubscriber}
 * on `kernel.response`. Exceptions are not used because the legacy 400/403/503 bodies keep the
 * resource shape rather than the JSON:API error envelope.
 */
class HealthCheckStorefrontProvider extends AbstractStorefrontProvider
{
    protected const string QUERY_PARAMETER_SERVICES = 'services';

    /**
     * Request attribute that carries the HTTP status code derived from the processor's response,
     * picked up by {@see HealthCheckResponseStatusSubscriber} on `kernel.response`.
     */
    public const string REQUEST_ATTRIBUTE_HEALTH_CHECK_STATUS_CODE = '_spryker_health_check_status_code';

    public function __construct(
        protected SerializerServiceInterface $serializer,
        protected HealthCheckReaderInterface $healthCheckReader,
    ) {
    }

    protected function provideItem(): ?object
    {
        $requestedServices = $this->getRequest()->query->get(static::QUERY_PARAMETER_SERVICES);

        $healthCheckResponseTransfer = $this->healthCheckReader->processHealthCheck(
            $requestedServices !== null ? (string)$requestedServices : null,
        );

        $this->getRequest()->attributes->set(
            static::REQUEST_ATTRIBUTE_HEALTH_CHECK_STATUS_CODE,
            (int)$healthCheckResponseTransfer->getStatusCode(),
        );

        return $this->serializer->denormalize(
            $healthCheckResponseTransfer->toArray(true, true),
            HealthCheckStorefrontResource::class,
        );
    }
}
