<?php
declare(strict_types=1);

namespace TicTacToe\Engine\Domain\Model\Board;

use TicTacToe\Engine\Domain\Model\Board\Exception\SorryInvalidPosition;

final class Position
{
    private const VALID_POSITIONS = [
        0, 1, 2, 3, 4, 5, 6, 7, 8
    ];

    private int $position;

    public function __construct(int $position)
    {
        self::isValid($position);

        $this->position = $position;
    }

    public function position(): int
    {
        return $this->position;
    }

    /**
     * @return array<int>
     */
    public static function positions(): array
    {
        return self::VALID_POSITIONS;
    }

    public static function isValid(int $position): bool
    {
        if (!in_array($position, self::VALID_POSITIONS, true)) {
            throw new SorryInvalidPosition('Out of boundary position.');
        }

        return true;
    }
}
