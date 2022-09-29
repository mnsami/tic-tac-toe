<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Domain\Model\Board;

use TicTacToe\Engine\Domain\Model\Player\PlayerToken;

final class Cell
{
    private string $value;

    public function __construct(string $value = '')
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function isEmpty(): bool
    {
        return empty($this->value);
    }

    public static function empty(): Cell
    {
        return new Cell();
    }

    public static function createFromPlayerToken(PlayerToken $playerToken): Cell
    {
        return new Cell((string) $playerToken);
    }
}
