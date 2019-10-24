<?php
declare(strict_types=1);

namespace TicTacToe\Engine\Application\PlayNewTurn;

use TicTacToe\Shared\Application\Command;

final class PlayNewTurnCommand implements Command
{
    /** @var string */
    private $playerId;

    /** @var int */
    private $position;

    /** @var string */
    private $gameId;

    public function __construct(
        string $playerId,
        int $position,
        string $gameId
    ) {
        $this->playerId = $playerId;
        $this->position = $position;
        $this->gameId = $gameId;
    }

    public function gameId(): string
    {
        return $this->gameId;
    }

    public function playerId(): string
    {
        return $this->playerId;
    }

    public function position(): int
    {
        return $this->position;
    }
}
