<?php

declare(strict_types = 1);

namespace TicTacToe\Shared\Infrastructure;

use TicTacToe\Shared\Domain\Model\Event;

interface EventStore
{
    public function store(Event $event);
}
