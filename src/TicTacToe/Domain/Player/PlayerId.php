<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Player;

use Ramsey\Uuid\Uuid;

final class PlayerId
{
    /** @var string */
    private $id;

    public function __construct(?string $id = null)
    {
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
    }

    public function equals(PlayerId $playerId)
    {
        return $this->id === (string) $playerId;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
