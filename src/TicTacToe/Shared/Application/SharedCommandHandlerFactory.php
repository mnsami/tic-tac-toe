<?php

declare(strict_types=1);

namespace TicTacToe\Shared\Application;

use TicTacToe\Shared\Infrastructure\CommandBus\Exception\SorryCommandHandlerNotFound;

abstract class SharedCommandHandlerFactory implements CommandHandlerFactory
{
    /**
     * @throws SorryCommandHandlerNotFound
     */
    public function create(Command $command): CommandHandler
    {
        $handlers = $this::commandHandlers();
        $commandName = get_class($command);
        if ($this->supports($command)) {
            throw new SorryCommandHandlerNotFound($commandName);
        }

        $callBack = $handlers[$commandName];
        return $callBack();
    }

    public function supports(Command $command): bool
    {
        $handlers = $this::commandHandlers();
        $commandName = get_class($command);

        return array_key_exists($commandName, $handlers);
    }

    /**
     * @return \Closure[]
     */
    abstract protected static function commandHandlers(): array;
}
