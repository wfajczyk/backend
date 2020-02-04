<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 *
 */

declare(strict_types = 1);

namespace Ergonode\Comment\Persistence\Dbal\Repository;

use Ergonode\Comment\Domain\Entity\Comment;
use Ergonode\Comment\Domain\Entity\CommentId;
use Ergonode\Comment\Domain\Repository\CommentRepositoryInterface;
use Ergonode\EventSourcing\Domain\AbstractAggregateRoot;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\Stream;
use Prooph\EventStore\StreamName;

/**
 */
class EventStore extends AggregateRepository implements CommentRepositoryInterface
{
    /**
     * EventStore constructor.
     * @param \Prooph\EventStore\EventStore $commentEventStore
     * @param string                        $commentStoreName
     */
    public function __construct(\Prooph\EventStore\EventStore $commentEventStore, string $commentStoreName)
    {
        $streamName = new StreamName($commentStoreName);
        $stream = new Stream($streamName, new \ArrayIterator());
        if (!$commentEventStore->hasStream($streamName)) {
            $commentEventStore->create($stream);
        }

        parent::__construct(
            $commentEventStore,
            AggregateType::fromAggregateRootClass(Comment::class),
            new AggregateTranslator(),
            null,
            $streamName
        );

    }

    /**
     * @param CommentId $id
     * @return Comment|null
     */
    public function load(CommentId $id): ?Comment
    {
        return $this->getAggregateRoot($id->getValue());
    }

    public function save(Comment $object): void
    {
        $this->saveAggregateRoot($object);
    }

    public function exists(CommentId $id): bool
    {
        return $this->getAggregateRoot($id->getValue()) !== null;
    }

    public function delete(Comment $object): void
    {
        // TODO: Implement delete() method.
    }


}
