<?php

declare(strict_types = 1);

namespace TicTacToe\Shared\Infrastructure\CommandBus;

use TicTacToe\Shared\Application\Command;
use TicTacToe\Shared\Application\CommandHandler;
use TicTacToe\Shared\Application\DataTransformer;
use TicTacToe\Shared\Infrastructure\CommandBus;
use TicTacToe\Shared\Infrastructure\CommandBus\Exception\SorryCommandHandlerNotFound;

final class CommandBusFactory implements CommandBus
{
    /** @var array<string, CommandHandler>  */
    private array $commandHandlers;

    public function __construct()
    {
        $this->commandHandlers = [];
    }

    /**
     * @param Command $command
     * @return DataTransformer
     * @throws SorryCommandHandlerNotFound
     */
    public function handle(Command $command): DataTransformer
    {
        $class = get_class($command);
        if (!isset($this->commandHandlers[$class])) {
            throw new SorryCommandHandlerNotFound($class);
        }

        $handler = $this->commandHandlers[$class];
        return $handler->handle($command);
    }

    /**
     * @param Command $command
     * @param CommandHandler $commandHandler
     */
    public function register(Command $command, CommandHandler $commandHandler): void
    {
        $class = get_class($command);
        $this->commandHandlers[$class] = $commandHandler;
    }
}
