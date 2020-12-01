<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Editor\Infrastructure\Handler;

use Ergonode\Account\Application\Security\Security;
use Ergonode\Attribute\Domain\Repository\AttributeRepositoryInterface;
use Ergonode\Editor\Domain\Repository\ProductDraftRepositoryInterface;
use Webmozart\Assert\Assert;
use Ergonode\Value\Domain\ValueObject\ValueInterface;
use Ergonode\Core\Domain\ValueObject\Language;
use Ergonode\Core\Domain\ValueObject\TranslatableString;
use Ergonode\Value\Domain\ValueObject\TranslatableStringValue;
use Ergonode\Editor\Domain\Command\RemoveProductAttributeValueCommand;
use Ergonode\Value\Domain\ValueObject\StringCollectionValue;

class RemoveProductAttributeValueCommandHandler extends AbstractValueCommandHandler
{
    private ProductDraftRepositoryInterface $repository;

    private AttributeRepositoryInterface $attributeRepository;

    private Security $security;

    public function __construct(
        ProductDraftRepositoryInterface $repository,
        AttributeRepositoryInterface $attributeRepository,
        Security $security
    ) {
        $this->repository = $repository;
        $this->attributeRepository = $attributeRepository;
        $this->security = $security;
    }


    /**
     * @throws \Exception
     */
    public function __invoke(RemoveProductAttributeValueCommand $command): void
    {
        $language = $command->getLanguage();
        $draft = $this->repository->load($command->getId());
        $attributeId = $command->getAttributeId();
        $attribute = $this->attributeRepository->load($attributeId);

        Assert::notNull($draft);
        Assert::notNull($attribute);

        if (!$draft->hasAttribute($attribute->getCode())) {
            return;
        }

        $oldValue = $draft->getAttribute($attribute->getCode());
        $newValue = $this->calculate($oldValue, $language);

        if ($newValue && !empty($newValue->getValue())) {
            $draft->changeAttribute($attribute->getCode(), $newValue);
        } else {
            $draft->removeAttribute($attribute->getCode());
        }

        $user = $this->security->getUser();
        if ($user) {
            $this->updateAudit($user, $draft);
        }

        $this->repository->save($draft);
    }

    public function calculate(ValueInterface $value, Language $language): ?ValueInterface
    {
        if ($value instanceof TranslatableStringValue) {
            $translation = $value->getValue();
            if (array_key_exists($language->getCode(), $translation)) {
                unset($translation[$language->getCode()]);
            }

            return new TranslatableStringValue(new TranslatableString($translation));
        }

        if ($value instanceof StringCollectionValue) {
            $translation = $value->getValue();
            if (array_key_exists($language->getCode(), $translation)) {
                unset($translation[$language->getCode()]);
            }

            return new StringCollectionValue($translation);
        }

        return null;
    }
}
