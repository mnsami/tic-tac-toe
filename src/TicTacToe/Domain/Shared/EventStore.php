<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Shared;

interface EventStore
{
    public function store(Event $event);
}
