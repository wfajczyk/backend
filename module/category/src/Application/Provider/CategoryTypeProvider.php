<?php

/**
 * Copyright © Ergonode Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Category\Application\Provider;

class CategoryTypeProvider
{
    /**
     * @var string[]
     */
    private array $types;

    public function __construct(string ...$types)
    {
        $this->types = $types;
    }

    /**
     * @return array
     */
    public function provide(): array
    {
        return $this->types;
    }
}
