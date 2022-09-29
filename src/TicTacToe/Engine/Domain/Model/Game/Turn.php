<?php
declare(strict_types=1);

namespace TicTacToe\Engine\Domain\Model\Game;

use TicTacToe\Engine\Domain\Model\Board\Cell;
use TicTacToe\Engine\Domain\Model\Board\Position;
use TicTacToe\Engine\Domain\Model\Player\Player;

final class Turn
{
    private GameId $gameId;

    private TurnId $moveId;

    private Cell $cell;

    private Player $madeBy;

    private Position $position;

    private \DateTimeImmutable $createdAt;

    public function __construct(
        GameId $gameId,
        TurnId $moveId,
        Cell $cell,
        Position $position,
        Player $madeBy
    ) {
        $this->gameId = $gameId;
        $this->moveId = $moveId;
        $this->cell = $cell;
        $this->madeBy = $madeBy;
        $this->position = $position;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function gameId(): GameId
    {
        return $this->gameId;
    }

    public function moveId(): TurnId
    {
        return $this->moveId;
    }

    public function madeBy(): Player
    {
        return $this->madeBy;
    }

    public function cell(): Cell
    {
        return $this->cell;
    }

    public function position(): Position
    {
        return $this->position;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
