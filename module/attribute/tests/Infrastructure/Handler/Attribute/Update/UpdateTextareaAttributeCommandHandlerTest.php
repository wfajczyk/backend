<?php

/**
 * Copyright © Ergonode Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Attribute\Tests\Infrastructure\Handler\Attribute\Update;

use Ergonode\Attribute\Domain\Command\Attribute\Update\UpdateTextareaAttributeCommand;
use Ergonode\Attribute\Domain\Entity\AbstractAttribute;
use Ergonode\Attribute\Domain\Entity\Attribute\TextareaAttribute;
use Ergonode\Attribute\Domain\Repository\AttributeRepositoryInterface;
use Ergonode\Attribute\Infrastructure\Handler\Attribute\Update\UpdateTextareaAttributeCommandHandler;
use Ergonode\Core\Domain\ValueObject\TranslatableString;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UpdateTextareaAttributeCommandHandlerTest extends TestCase
{
    /**
     * @var UpdateTextareaAttributeCommand|MockObject
     */
    private $command;

    /**
     * @var AttributeRepositoryInterface|MockObject
     */
    private $repository;

    /**
     * @var AbstractAttribute|MockObject
     */
    private $attribute;

    protected function setUp(): void
    {
        $this->command = $this->createMock(UpdateTextareaAttributeCommand::class);
        $this->command->method('getLabel')->willReturn(new TranslatableString());
        $this->command->method('getPlaceholder')->willReturn(new TranslatableString());
        $this->command->method('getHint')->willReturn(new TranslatableString());
        $this->repository = $this->createMock(AttributeRepositoryInterface::class);
        $this->attribute = $this->createMock(TextareaAttribute::class);
        $this->attribute->method('getGroups')->willReturn([]);
    }

    public function testAttributeNotFound(): void
    {
        $this->expectException(\LogicException::class);
        $this->repository->method('load')->willReturn(null);

        $handler = new UpdateTextareaAttributeCommandHandler($this->repository);
        $handler->__invoke($this->command);
    }

    public function testUpdate(): void
    {
        $this->repository->method('load')->willReturn($this->attribute);
        $this->repository->expects($this->once())->method('save');

        $handler = new UpdateTextareaAttributeCommandHandler($this->repository);
        $handler->__invoke($this->command);
    }
}
