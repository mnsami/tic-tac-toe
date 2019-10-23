<?php
declare(strict_types=1);

namespace TicTacToe\Engine\Domain\Model\Board;

use TicTacToe\Engine\Domain\Model\Board\Exception\SorryInvalidPosition;

final class Position
{
    public const Valid_Positions = [
        0, 1, 2, 3, 4, 5, 6, 7, 8
    ];

    /** @var int */
    private $position;

    public function __construct(int $position)
    {
        if (!in_array($position, self::Valid_Positions, true)) {
            throw new SorryInvalidPosition('Out of boundary position.');
        }

        $this->position = $position;
    }

    public function position(): int
    {
        return $this->position;
    }
}
