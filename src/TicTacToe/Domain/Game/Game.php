<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Game;

use TicTacToe\Domain\Board\Board;
use TicTacToe\Domain\Game\Exception\SorryTooManyPlayers;
use TicTacToe\Domain\Player\Player;
use TicTacToe\Domain\Player\PlayerSet;

final class Game
{
    /** @var PlayerSet */
    private $players;

    /** @var Board */
    private $board;

    public const MAX_PLAYERS = 2;

    public function __construct(Board $board, Player ...$players)
    {
        if (count($players) > self::MAX_PLAYERS) {
            throw new SorryTooManyPlayers("Only " . self::MAX_PLAYERS . " players allowed.");
        }

        $this->board = $board;
        $this->players = new PlayerSet($players);
    }
}
