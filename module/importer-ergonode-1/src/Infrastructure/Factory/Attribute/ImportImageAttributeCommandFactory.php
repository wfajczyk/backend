<?php
/**
 * Copyright © Ergonode Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\ImporterErgonode1\Infrastructure\Factory\Attribute;

use Ergonode\Attribute\Domain\Entity\Attribute\ImageAttribute;
use Ergonode\Importer\Domain\Command\Import\Attribute\ImportImageAttributeCommand;
use Ergonode\Importer\Domain\Entity\Import;
use Ergonode\ImporterErgonode1\Infrastructure\Model\AttributeModel;
use Ergonode\SharedKernel\Domain\Aggregate\ImportLineId;
use Ergonode\SharedKernel\Domain\DomainCommandInterface;

class ImportImageAttributeCommandFactory implements ImportAttributeCommandFactoryInterface
{
    public function supports(string $type): bool
    {
        return ImageAttribute::TYPE === $type;
    }

    public function create(ImportLineId $id, Import $import, AttributeModel $model): DomainCommandInterface
    {
        return new ImportImageAttributeCommand(
            $id,
            $import->getId(),
            $model->getCode(),
            $model->getType(),
            $model->getName(),
            $model->getHint(),
            $model->getPlaceholder(),
            $model->getScope(),
            $model->getParameters()
        );
    }
}
