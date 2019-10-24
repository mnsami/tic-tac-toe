<?php
declare(strict_types=1);

namespace TicTacToe\Engine\Application\PlayNewTurn;

use TicTacToe\Engine\Domain\Model\Board\Cell;
use TicTacToe\Engine\Domain\Model\Board\Position;
use TicTacToe\Engine\Domain\Model\Game\Exception\SorryGameNotFound;
use TicTacToe\Engine\Domain\Model\Game\GameId;
use TicTacToe\Engine\Domain\Model\Game\GameRepository;
use TicTacToe\Engine\Domain\Model\Game\Turn;
use TicTacToe\Engine\Domain\Model\Game\TurnId;
use TicTacToe\Engine\Domain\Model\Game\TurnRepository;
use TicTacToe\Engine\Domain\Model\Player\Exception\SorryPlayerNotFound;
use TicTacToe\Engine\Domain\Model\Player\PlayerId;
use TicTacToe\Engine\Domain\Model\Player\PlayerRepository;
use TicTacToe\Shared\Application\Command;
use TicTacToe\Shared\Application\CommandHandler;
use TicTacToe\Shared\Application\DataTransformer;
use TicTacToe\Shared\Application\Exception\SorryWrongCommand;

final class PlayNewTurnHandler implements CommandHandler
{
    /** @var TurnRepository */
    private $turnRepository;

    /** @var PlayerRepository */
    private $playerRepository;

    /** @var GameRepository */
    private $gameRepository;

    public function __construct(
        TurnRepository $turnRepository,
        PlayerRepository $playerRepository,
        GameRepository $gameRepository
    ) {
        $this->turnRepository = $turnRepository;
        $this->playerRepository = $playerRepository;
        $this->gameRepository = $gameRepository;
    }

    /**
     * @inheritDoc
     */
    public function handles(): string
    {
        return PlayNewTurnCommand::class;
    }

    /**
     * @inheritDoc
     */
    public function handle(Command $command): DataTransformer
    {
        if (!$command instanceof PlayNewTurnCommand) {
            throw new SorryWrongCommand();
        }

        $playerId = $command->playerId();
        $player = $this->playerRepository->ofId(new PlayerId($playerId));
        if ($player === null) {
            throw new SorryPlayerNotFound("Player of Id {$playerId} not found.");
        }

        $gameId = $command->gameId();
        $game = $this->gameRepository->ofId(new GameId($gameId));
        if ($game === null) {
            throw new SorryGameNotFound("Game of Id {$gameId} not found.");
        }

        $turn = new Turn(
            new TurnId(),
            Cell::createFromPlayerToken($player->playingToken()),
            new Position($command->position()),
            $player
        );

        $game->playerMakeTurn(
            $turn
        );

        $this->turnRepository->add($turn);
    }
}
