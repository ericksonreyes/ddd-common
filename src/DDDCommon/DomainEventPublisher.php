<?php

namespace DDDCommon;

/**
 * Interface DomainEventPublishers
 * @package DDDCommon
 */
interface DomainEventPublisher
{
    /**
     * @param DomainEvent $domainEvent
     */
    public function publish(DomainEvent $domainEvent): void;
}
