<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Game;

use Ramsey\Uuid\Uuid;

final class GameId
{
    /** @var string */
    private $id;

    public function __construct(?string $id = null)
    {
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
    }

    public function equals(GameId $gameId)
    {
        return $this->id === (string) $gameId;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
