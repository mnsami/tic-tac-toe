<?php
declare(strict_types=1);

namespace TicTacToe\Engine\Domain\Model\Game;

use TicTacToe\Engine\Domain\Model\Board\Cell;
use TicTacToe\Engine\Domain\Model\Board\Position;
use TicTacToe\Engine\Domain\Model\Player\Player;

final class Move
{
    /** @var MoveId */
    private $moveId;

    /** @var Cell */
    private $cell;

    /** @var Player */
    private $madeBy;

    /** @var Position */
    private $position;

    public function __construct(
        MoveId $moveId,
        Cell $cell,
        Position $position,
        Player $madeBy
    ) {
        $this->moveId = $moveId;
        $this->cell = $cell;
        $this->madeBy = $madeBy;
        $this->position = $position;
    }

    public function moveId(): MoveId
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
}
