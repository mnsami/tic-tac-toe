<?php

declare(strict_types = 1);

namespace TicTacToe\Shared\Application;

interface CommandHandler
{
    /**
     * Command class name
     *
     * @return string
     */
    public function handles(): string;
}
