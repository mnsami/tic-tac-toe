<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Shared;

interface CommandHandler
{
    /**
     * Command class name
     *
     * @return string
     */
    public function handles(): string;
}
