<?php

/**
 * Copyright © Ergonode Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Attribute\Domain\Entity\Attribute;

class FileAttribute extends AbstractCollectionAttribute
{
    public const TYPE = 'FILE';

    public function getType(): string
    {
        return self::TYPE;
    }
}
