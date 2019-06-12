<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Model\Player\Event;

use TicTacToe\Domain\Model\Player\Player;
use TicTacToe\Shared\Infrastructure\Event;

final class PlayerCreated implements Event
{
    /** @var Player */
    private $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @inheritDoc
     */
    public function occurredAt(): \DateTimeImmutable
    {
        return $this->player->createdAt();
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'playerId' => (string) $this->player->id(),
            'playerName' => $this->player->name(),
            'playerToken' => $this->player->playingToken(),
            'createdAt' => $this->player->createdAt()->format(\DateTimeImmutable::ATOM)
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
