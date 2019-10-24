<?php
declare(strict_types=1);

namespace TicTacToe\Engine\Domain\Model\Game;

use Ramsey\Uuid\Uuid;

final class TurnId
{
    /** @var string */
    private $id;

    public function __construct(?string $id = null)
    {
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
    }

    public function equals(TurnId $moveId)
    {
        return $this->id === (string)$moveId;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
