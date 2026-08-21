<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\HealthCheck\ChainFilter;

interface ChainFilterAddInterface
{
    /**
     * @return $this
     */
    public function addFilter(FilterInterface $filter);
}
