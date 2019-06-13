<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Application\CreateNewGame;

use TicTacToe\Shared\Application\Command;

final class CreateNewGameCommand implements Command
{
    /** @var array */
    private $playerIds;

    /** @var int */
    private $boardSize;

    public function __construct(array $playerIds, int $boardSize)
    {
        $this->playerIds = $playerIds;
        $this->boardSize = $boardSize;
    }

    public function playerIds(): array
    {
        return $this->playerIds;
    }

    public function boardSize(): int
    {
        return $this->boardSize;
    }
}
