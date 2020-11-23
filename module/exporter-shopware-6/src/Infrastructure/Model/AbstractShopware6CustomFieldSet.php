<?php
/*
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\ExporterShopware6\Infrastructure\Model;

use JMS\Serializer\Annotation as JMS;

abstract class AbstractShopware6CustomFieldSet
{
    /**
     * @JMS\Exclude()
     */
    protected ?string $id;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("name")
     */
    protected ?string $name;

    /**
     * @var ?array
     *
     * @JMS\Type("array")
     * @JMS\SerializedName("config")
     */
    protected ?array $config;

    /**
     * @var ?array
     *
     * @JMS\Type("array")
     * @JMS\SerializedName("relations")
     */
    protected ?array $relations;

    /**
     * @JMS\Exclude()
     */
    protected bool $modified = false;

    /**
     * @param array|null $relations
     * @param array|null $config
     */
    public function __construct(
        ?string $id = null,
        ?string $name = null,
        ?array $config = null,
        ?array $relations = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->config = $config;
        $this->relations = $relations;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        if ($name !== $this->name) {
            $this->name = $name;
            $this->modified = true;
        }
    }

    /**
     * @return array
     */
    public function getRelations(): array
    {
        return $this->relations;
    }

    /**
     * @param array $relations
     */
    public function addRelation(array $relations): void
    {
        $this->relations[] = $relations;
    }

    public function setLabel(array $label): void
    {
        if (isset($this->config['label'])) {
            if (!empty(array_diff($this->config['label'], $label))) {
                $this->config['label'] = $label;
                $this->modified = true;
            }
        } else {
            $this->config['label'] = $label;
            $this->modified = true;
        }
    }

    public function isModified(): bool
    {
        return $this->modified;
    }
}
