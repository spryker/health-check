<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\HealthCheck\Api\Storefront\EventSubscriber;

use Spryker\ApiPlatform\Attribute\ApiType;
use Spryker\Glue\HealthCheck\Api\Storefront\Provider\HealthCheckStorefrontProvider;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Rewrites the HTTP response status for `GET /health-check` from the integer carried on the
 * `REQUEST_ATTRIBUTE_HEALTH_CHECK_STATUS_CODE` request attribute (set by
 * {@see HealthCheckStorefrontProvider::provideItem()}). The body itself is produced by the
 * standard API Platform pipeline; only the status line is overridden, so the legacy mapping of
 * `statusCode` → HTTP status is preserved (200 healthy, 400 bad request, 403 disabled, 503
 * unhealthy) without resorting to exception-driven error envelopes.
 */
#[ApiType(types: ['storefront'])]
class HealthCheckResponseStatusSubscriber implements EventSubscriberInterface
{
    /**
     * @return array<string, string>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $statusCode = $event->getRequest()->attributes->get(
            HealthCheckStorefrontProvider::REQUEST_ATTRIBUTE_HEALTH_CHECK_STATUS_CODE,
        );

        if ($statusCode === null) {
            return;
        }

        $event->getResponse()->setStatusCode((int)$statusCode);
    }
}
