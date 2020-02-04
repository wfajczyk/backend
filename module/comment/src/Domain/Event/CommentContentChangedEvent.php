<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Comment\Domain\Event;

use Ergonode\Comment\Domain\Entity\CommentId;
use Ergonode\Core\Domain\Entity\AbstractId;
use Prooph\EventSourcing\AggregateChanged;
use Ramsey\Uuid\Uuid;

/**
 */
class CommentContentChangedEvent extends AggregateChanged
{
    /**
     * @param CommentId $id
     * @param string    $from
     * @param string    $to
     */
    public function __construct(CommentId $id, string $from, string $to)
    {
        parent::__construct(
          $id->getValue(),
          [
              'comment_id' => $id->getValue(),
              'from' => $from,
              'to' => $to,
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
     * @return string
     */
    public function getFrom(): string
    {
        return $this->payload['from'];
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->payload['to'];
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getEditedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
