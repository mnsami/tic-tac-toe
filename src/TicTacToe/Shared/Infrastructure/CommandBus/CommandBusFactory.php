<?php

declare(strict_types = 1);

namespace TicTacToe\Shared\Infrastructure\CommandBus;

use TicTacToe\Shared\Application\Command;
use TicTacToe\Shared\Application\CommandHandlerFactory;
use TicTacToe\Shared\Application\DataTransformer;
use TicTacToe\Shared\Infrastructure\EventStore;

final class CommandBusFactory implements CommandBus
{
    private CommandHandlerFactory $commandHandlerFactory;

    private EventStore $eventStore;

    public function __construct(CommandHandlerFactory $commandHandlerFactory, EventStore $eventStore)
    {
        $this->commandHandlerFactory = $commandHandlerFactory;
        $this->eventStore = $eventStore;
    }

    /**
     * @param Command $command
     * @return DataTransformer
     */
    public function handle(Command $command): DataTransformer
    {
        $handler = $this->commandHandlerFactory->create($command);
        return $handler->handle($command);
    }

    public function events(): array
    {
        return $this->eventStore->events();
    }
}
