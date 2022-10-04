<?php

declare(strict_types=1);

namespace TicTacToe\Engine\Infrastructure\CommandBus;

use TicTacToe\Engine\Application\CreateNewGame\CreateNewGameCommand;
use TicTacToe\Engine\Application\CreateNewGame\CreateNewGameHandler;
use TicTacToe\Engine\Application\CreateNewPlayer\CreateNewPlayerCommand;
use TicTacToe\Engine\Application\CreateNewPlayer\CreateNewPlayerHandler;
use TicTacToe\Engine\Infrastructure\Persistence\InMemory\InMemoryGameRepository;
use TicTacToe\Engine\Infrastructure\Persistence\InMemory\InMemoryPlayerRepository;
use TicTacToe\Shared\Application\SharedCommandHandlerFactory;

final class GameCommandHandlerFactory extends SharedCommandHandlerFactory
{
    /**
     * @return \Closure[]
     */
    protected static function commandHandlers(): array
    {
        $gameRepository = new InMemoryGameRepository();
        $playerRepository = new InMemoryPlayerRepository();

        return [
            CreateNewGameCommand::class => function () use ($gameRepository) {
                return new CreateNewGameHandler($gameRepository);
            },
            CreateNewPlayerCommand::class => function () use ($playerRepository) {
                return new CreateNewPlayerHandler($playerRepository);
            }
        ];
    }
}
