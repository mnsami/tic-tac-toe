<?php

declare(strict_types = 1);

namespace TicTacToe\Shared\Domain\Model;

abstract class AggregateRoot
{
    /** @var Event[] */
    private array $events;

    public function __construct()
    {
        $this->events = [];
    }

    /**
     * @return Event[]
     */
    public function getRecordedEvents(): array
    {
        return $this->events;
    }

    public function resetRecordedEvents(): void
    {
        $this->events = [];
    }

    protected function record(Event $event): void
    {
        $this->events[] = $event;
    }
}
