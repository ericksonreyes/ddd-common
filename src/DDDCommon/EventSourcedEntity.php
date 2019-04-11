<?php

namespace DDDCommon;

use DDDCommon\Exception\MissingEventReplayMethodException;

/**
 * Class EventSourcedEntity
 * @package DDDCommon
 */
abstract class EventSourcedEntity
{
    /**
     * @var DomainEvent[]
     */
    private $storedEvents = [];

    /**
     * @return DomainEvent[]
     */
    final public function storedEvents(): array
    {
        return $this->storedEvents;
    }

    final public function clearStoredEvents(): void
    {
        $this->storedEvents = [];
    }

    /**
     * @param DomainEvent $event
     * @return bool
     */
    final public function isTheFirstOccurrenceOfThis(DomainEvent $event): bool
    {
        foreach ($this->storedEvents() as $storedEvent) {
            if ($storedEvent instanceof $event) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $eventClassName
     * @return bool
     */
    final public function eventAlreadyHappened(string $eventClassName): bool
    {
        foreach ($this->storedEvents() as $storedEvent) {
            if ($storedEvent instanceof $eventClassName) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $eventClassName
     * @return bool
     */
    final public function eventNeverHappened(string $eventClassName): bool
    {
        return !$this->eventAlreadyHappened($eventClassName);
    }

    /**
     * @return bool
     */
    abstract public function isDeleted(): bool;

    /**
     * @param DomainEvent $domainEvent
     */
    public function replayThis(DomainEvent $domainEvent): void
    {
        $eventMethod = 'replay' . $domainEvent->eventName();
        if (method_exists($this, $eventMethod) === false) {
            throw new MissingEventReplayMethodException(
                'Missing event replay method ' . $eventMethod . '.'
            );
        }
        $this->$eventMethod($domainEvent);
    }

    /**
     * @param DomainEvent $event
     */
    final protected function storeAndReplayThis(DomainEvent $event): void
    {
        $this->storeThis($event);
        $this->replayThis($event);
    }

    /**
     * @param DomainEvent $event
     */
    final protected function storeThis(DomainEvent $event): void
    {
        $this->storedEvents[] = $event;
    }
}
