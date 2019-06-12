<?php

declare(strict_types = 1);

namespace TicTacToe\Shared\Infrastructure\CommandBus;

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
