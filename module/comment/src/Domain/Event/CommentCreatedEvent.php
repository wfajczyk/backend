<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Comment\Domain\Event;

use Ergonode\Account\Domain\Entity\UserId;
use Ergonode\Core\Domain\Entity\AbstractId;
use Ergonode\Comment\Domain\Entity\CommentId;
use Ergonode\EventSourcing\Infrastructure\DomainEventInterface;
use Prooph\EventSourcing\AggregateChanged;
use Ramsey\Uuid\Uuid;

/**
 */
class CommentCreatedEvent extends AggregateChanged implements DomainEventInterface
{
    /**
     * @param CommentId $id
     * @param UserId    $authorId
     * @param Uuid      $objectId
     * @param string    $content
     */
    public function __construct(CommentId $id, UserId $authorId, Uuid $objectId, string $content)
    {
        parent::__construct(
            $id->getValue(),
            [
                'comment_id' => $id->getValue(),
                'author_id' => $authorId->getValue(),
                'object_id' => $objectId->toString(),
                'content' => $content,
            ]
        );

    }

    /**
     * @return CommentId|AbstractId
     */
    public function getAggregateId(): AbstractId
    {
        return CommentId::createFromUuid(Uuid::fromString($this->aggregateId()));
    }

    /**
     * @return UserId
     */
    public function getAuthorId(): UserId
    {
        return UserId::createFromUuid(Uuid::fromString($this->payload['author_id']));
    }

    /**
     * @return Uuid
     */
    public function getObjectId(): Uuid
    {
        return Uuid::fromString($this->payload['object_id']);
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->payload['content'];
    }
}
