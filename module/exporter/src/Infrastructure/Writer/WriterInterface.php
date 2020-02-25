<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 *
 */

declare(strict_types = 1);

namespace Ergonode\Exporter\Infrastructure\Writer;

/**
 */
interface WriterInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function generate(array $data);
}
