<?php

declare(strict_types = 1);

namespace TicTacToe\Shared\Infrastructure;

use TicTacToe\Shared\Application\Command;
use TicTacToe\Shared\Application\CommandHandler;
use TicTacToe\Shared\Application\DataTransformer;

interface CommandBus
{
    /**
     * @param Command $command
     * @return DataTransformer
     */
    public function handle(Command $command): DataTransformer;

    /**
     * @param Command $command
     * @param CommandHandler $commandHandler
     */
    public function register(Command $command, CommandHandler $commandHandler): void;
}
