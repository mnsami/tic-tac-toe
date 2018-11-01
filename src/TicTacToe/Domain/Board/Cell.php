<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Board;

use TicTacToe\Domain\Player\PlayerToken;

final class Cell
{
    /** @var PlayerToken|null */
    private $value;

    public function __construct(?PlayerToken $value = null)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public static function empty(): Cell
    {
        return new Cell();
    }
}
