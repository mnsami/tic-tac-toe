<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Domain\Model\Game;

use TicTacToe\Engine\Domain\Model\Board\Board;
use TicTacToe\Engine\Domain\Model\Game\Event\GameCreated;
use TicTacToe\Engine\Domain\Model\Game\Event\PlayerTurnPlayed;
use TicTacToe\Engine\Domain\Model\Game\Exception\SorryTooManyPlayers;
use TicTacToe\Engine\Domain\Model\Player\PlayerId;
use TicTacToe\Engine\Domain\Model\Player\PlayerIdSet;
use TicTacToe\Shared\Domain\Model\AggregateRoot;

final class Game extends AggregateRoot
{
    private GameId $id;

    private PlayerIdSet $playerIds;

    private Board $board;

    private \DateTimeImmutable $createdAt;

    public const MAX_PLAYERS = 2;

    /**
     * @throws SorryTooManyPlayers
     */
    private function __construct(GameId $gameId, Board $board, PlayerId ...$playerIds)
    {
        parent::__construct();

        if (count($playerIds) > self::MAX_PLAYERS) {
            throw new SorryTooManyPlayers("Only " . self::MAX_PLAYERS . " players allowed.");
        }

        $this->id = $gameId;
        $this->board = $board;
        $this->playerIds = new PlayerIdSet(...$playerIds);
        $this->createdAt = new \DateTimeImmutable();
    }

    public static function start(GameId $gameId, Board $board, PlayerId ...$playerIds): self
    {
        $game = new self($gameId, $board, ...$playerIds);

        $game->record(
            new GameCreated($game)
        );

        return $game;
    }

    public function setBoardPiece(Turn $turn): void
    {
        $this->board->setCell($turn->position(), $turn->cell());
    }

    public function id(): GameId
    {
        return $this->id;
    }

    public function playerIds(): PlayerIdSet
    {
        return $this->playerIds;
    }

    public function board(): Board
    {
        return $this->board;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
