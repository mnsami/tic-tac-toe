<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Player;

use TicTacToe\Domain\Player\Exception\SorryPlayerNameIsTooLong;
use TicTacToe\Domain\Player\Exception\SorryPlayerNameIsTooShort;

final class PlayerName
{
    /** @var string */
    private $name;

    private const MAX_LENGTH = 15;
    private const MIN_LENGTH = 3;

    public function __construct(string $name)
    {
        if (strlen($name) < self::MIN_LENGTH) {
            throw new SorryPlayerNameIsTooShort("Player name is too short, minimum " . self::MIN_LENGTH);
        }

        if (strlen($name) > self::MAX_LENGTH) {
            throw new SorryPlayerNameIsTooLong("Player name is too long, maximum " . self::MAX_LENGTH);
        }

        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
