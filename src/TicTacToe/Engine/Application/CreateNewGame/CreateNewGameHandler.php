<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Application\CreateNewGame;

use TicTacToe\Engine\Domain\Model\Board\Board;
use TicTacToe\Engine\Domain\Model\Game\Game;
use TicTacToe\Engine\Domain\Model\Game\GameId;
use TicTacToe\Engine\Domain\Model\Game\GameRepository;
use TicTacToe\Engine\Domain\Model\Player\PlayerId;
use TicTacToe\Shared\Application\Command;
use TicTacToe\Shared\Application\CommandHandler;
use TicTacToe\Shared\Application\DataTransformer;
use TicTacToe\Shared\Application\Exception\SorryWrongCommand;

final class CreateNewGameHandler implements CommandHandler
{
    /** @var GameRepository */
    private $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * @inheritDoc
     */
    public function handles(): string
    {
        return CreateNewGameCommand::class;
    }

    /**
     * @inheritDoc
     */
    public function handle(Command $command): DataTransformer
    {
        if (!$command instanceof CreateNewGameCommand) {
            throw new SorryWrongCommand();
        }

        $playerIds = array_map(function (string $playerId) {
            return new PlayerId($playerId);
        }, $command->playerIds());

        $game = Game::start(
            new GameId(),
            new Board($command->boardSize()),
            ...$playerIds
        );

        $this->gameRepository->add($game);

        return new CreateNewGameResponseDto($game);
    }
}
