<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Player\Event;

use TicTacToe\Domain\Player\Player;
use TicTacToe\Domain\Shared\Event;

final class PlayerCreated implements Event
{
    /** @var Player */
    private $player;

    /** @var \DateTimeImmutable */
    private $createdAt;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @inheritDoc
     */
    public function occurredAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'playerId' => (string) $this->player->id(),
            'name' => $this->player->name(),
            'token' => $this->player->playingToken(),
            'createdAt' => $this->createdAt->format(\DateTimeImmutable::ATOM)
        ];
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return PlayerCreated::class;
    }
}
