<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Game;

use TicTacToe\Domain\Board\Board;
use TicTacToe\Domain\Game\Event\GameCreated;
use TicTacToe\Domain\Game\Exception\SorryTooManyPlayers;
use TicTacToe\Domain\Player\Player;
use TicTacToe\Domain\Player\PlayerSet;
use TicTacToe\Domain\Shared\AggregateRoot;

final class Game extends AggregateRoot
{
    /** @var GameId */
    private $id;

    /** @var PlayerSet */
    private $players;

    /** @var Board */
    private $board;

    /** @var \DateTimeImmutable */
    private $createdAt;

    public const MAX_PLAYERS = 2;

    private function __construct(GameId $gameId, Board $board, Player ...$players)
    {
        if (count($players) > self::MAX_PLAYERS) {
            throw new SorryTooManyPlayers("Only " . self::MAX_PLAYERS . " players allowed.");
        }

        $this->id = $gameId;
        $this->board = $board;
        $this->players = new PlayerSet(...$players);
        $this->createdAt = new \DateTimeImmutable();
    }

    public static function start(GameId $gameId, Board $board, Player ...$players)
    {
        $game = new self($gameId, $board, ...$players);

        $game->record(
            new GameCreated($game)
        );

        return $game;
    }

    public function id(): GameId
    {
        return $this->id;
    }

    public function players(): PlayerSet
    {
        return $this->players;
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
