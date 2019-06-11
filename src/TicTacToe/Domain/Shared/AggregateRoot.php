<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Shared;

abstract class AggregateRoot
{
    private $events = [];

    /**
     * @return array|Event[]
     */
    public function getRecordedEvents(): array
    {
        return $this->events;
    }

    public function resetRecordedEvents()
    {
        $this->events = [];
    }

    protected function record(Event $event)
    {
        $this->events[] = $event;
    }
}
