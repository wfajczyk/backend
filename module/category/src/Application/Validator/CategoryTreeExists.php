<?php
/**
 * Copyright © Ergonode Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Category\Application\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CategoryTreeExists extends Constraint
{
    public string $message = 'Category tree not exists.';
}
