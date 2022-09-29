<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Application\CreateNewGame;

use TicTacToe\Engine\Domain\Model\Player\PlayerId;
use TicTacToe\Shared\Application\Command;

final class CreateNewGameCommand implements Command
{
    /** @var array<int, string> */
    private array $playerIds;

    private int $boardSize;

    /**
     * @param array<int, string> $playerIds
     * @param int $boardSize
     */
    public function __construct(array $playerIds, int $boardSize)
    {
        $this->playerIds = $playerIds;
        $this->boardSize = $boardSize;
    }

    /**
     * @return array<int, string>
     */
    public function playerIds(): array
    {
        return $this->playerIds;
    }

    public function boardSize(): int
    {
        return $this->boardSize;
    }
}
