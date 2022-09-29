<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Infrastructure\Persistence\InMemory;

use TicTacToe\Shared\Domain\Model\Event;
use TicTacToe\Shared\Infrastructure\EventStore;

final class InMemoryEventStore implements EventStore
{
    /** @var Event[] */
    private array $events;

    public function __construct(Event ...$events)
    {
        $this->events = $events;
    }

    public function store(Event $event): void
    {
        $this->events[] = unserialize(serialize($event));
    }

    /**
     * @return Event[]
     */
    public function events(): array
    {
        return $this->events;
    }
}
