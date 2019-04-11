<?php

namespace DDDCommon;

use DateTimeImmutable;

/**
 * Interface DomainEvent
 * @package DDDCommon
 */
interface DomainEvent
{
    /**
     * @return string
     */
    public static function staticEventName(): string;

    /**
     * @return string
     */
    public static function staticEntityContext(): string;

    /**
     * @return string
     */
    public static function staticEntityType(): string;

    /**
     * @param array $array
     * @return DomainEvent
     */
    public static function fromArray(array $array): self;

    /**
     * @return DateTimeImmutable
     */
    public function happenedOn(): DateTimeImmutable;

    /**
     * @return string
     */
    public function eventName(): string;

    /**
     * @return string
     */
    public function entityContext(): string;

    /**
     * @return string
     */
    public function entityType(): string;

    /**
     * @return string
     */
    public function entityId(): string;

    /**
     * @return array
     */
    public function toArray(): array;
}
