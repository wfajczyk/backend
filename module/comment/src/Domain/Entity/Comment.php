<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Comment\Domain\Entity;

use Ergonode\Account\Domain\Entity\UserId;
use Ergonode\Core\Domain\Entity\AbstractId;
use Ergonode\Comment\Domain\Event\CommentContentChangedEvent;
use Ergonode\Comment\Domain\Event\CommentCreatedEvent;
use JMS\Serializer\Annotation as JMS;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use Ramsey\Uuid\Uuid;

/**
 */
class Comment extends AggregateRoot
{
    /**
     * @var CommentId $id
     *
     * @JMS\Type("Ergonode\Comment\Domain\Entity\CommentId")
     */
    private CommentId $id;

    /**
     * @var UserId $authorId
     *
     * @JMS\Type("Ergonode\Account\Domain\Entity\UserId")
     */
    private UserId $authorId;

    /**
     * @var Uuid
     *
     * @JMS\Type("uuid")
     */
    private Uuid $objectId;

    /**
     * @var \DateTimeImmutable $createdAt
     *
     * @JMS\Type("DateTimeImmutable")
     */
    private \DateTimeImmutable $createdAt;

    /**
     * @var null|\DateTimeImmutable $editedAt
     *
     * @JMS\Type("DateTimeImmutable")
     */
    private ?\DateTimeImmutable $editedAt = null;

    /**
     * @var string $content
     *
     * @JMS\Type("string")
     */
    private string $content;

    /**
     * @param CommentId $id
     * @param Uuid      $objectId
     * @param UserId    $authorId
     * @param string    $content
     *
     * @return Comment
     *
     * @throws \Exception
     */
    public static function create(CommentId $id, Uuid $objectId, UserId $authorId, string $content): Comment
    {
        $new = new self();
        $new->recordThat(
            new CommentCreatedEvent($id, $authorId, $objectId, $content)
        );

        return $new;
    }

    /**
     * @param string $contend
     *
     * @throws \Exception
     */
    public function changeContent(string $contend): void
    {
        if ($contend !== $this->content) {
            $this->recordThat(new CommentContentChangedEvent($this->id, $this->content, $contend));
        }
    }

    /**
     * @return CommentId
     */
    public function getId(): AbstractId
    {
        return $this->id;
    }

    /**
     * @return UserId
     */
    public function getAuthorId(): UserId
    {
        return $this->authorId;
    }

    /**
     * @return Uuid
     */
    public function getObjectId(): Uuid
    {
        return $this->objectId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getEditedAt(): ?\DateTimeImmutable
    {
        return $this->editedAt;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param CommentCreatedEvent $event
     */
    protected function applyCommentCreatedEvent(CommentCreatedEvent $event): void
    {
        $this->id = $event->getAggregateId();
        $this->authorId = $event->getAuthorId();
        $this->objectId = $event->getObjectId();
        $this->createdAt = $event->getCreatedAt();
        $this->content = $event->getContent();
    }

    /**
     * @param CommentContentChangedEvent $event
     */
    protected function applyCommentContentChangedEvent(CommentContentChangedEvent $event): void
    {
        $this->content = $event->getTo();
        $this->editedAt = $event->getEditedAt();
    }

    protected function aggregateId(): string
    {
        return $this->id->getValue();
    }

    /**
     * @param AggregateChanged $event
     */
    protected function apply(AggregateChanged $event): void
    {
        if ($event instanceof CommentCreatedEvent) {
            $this->applyCommentCreatedEvent($event);
        }
        if ($event instanceof CommentContentChangedEvent) {
            $this->applyCommentContentChangedEvent($event);
        }
    }


}
