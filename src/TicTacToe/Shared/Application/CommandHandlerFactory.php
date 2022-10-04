<?php

declare(strict_types = 1);

namespace TicTacToe\Shared\Application;

interface CommandHandlerFactory
{
    /**
     * @param Command $command
     * @return CommandHandler
     */
    public function create(Command $command): CommandHandler;

    /**
     * @param Command $command
     * @return bool
     */
    public function supports(Command $command): bool;
}
