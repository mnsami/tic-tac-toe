<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Domain\Model\Game;

use Ramsey\Uuid\Uuid;

final class GameId
{
    private string $id;

    public function __construct(?string $id = null)
    {
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
    }

    public function equals(GameId $gameId): bool
    {
        return $this->id === (string) $gameId;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
