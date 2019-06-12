<?php

declare(strict_types = 1);

namespace TicTacToe\Infrastructure\InMemory;

use TicTacToe\Domain\Shared\Event;
use TicTacToe\Domain\Shared\EventStore;

final class InMemoryEventStore implements EventStore
{
    private $events = [];

    public function store(Event $event)
    {
        $this->events[] = unserialize(serialize($event));
    }
}
