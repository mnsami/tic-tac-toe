<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Infrastructure\Persistence\InMemory;

use TicTacToe\Shared\Domain\Model\Event;
use TicTacToe\Shared\Infrastructure\EventStore;

final class InMemoryEventStore implements EventStore
{
    private $events = [];

    public function store(Event $event)
    {
        $this->events[] = unserialize(serialize($event));
    }
}
