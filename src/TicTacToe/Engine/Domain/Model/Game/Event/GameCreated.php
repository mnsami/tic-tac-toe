<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Model\Game\Event;

use TicTacToe\Domain\Game\Game;
use TicTacToe\Domain\Shared\Event;

final class GameCreated implements Event
{
    /** @var Game */
    private $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    /**
     * Return event timestamp
     *
     * @return \DateTimeImmutable
     */
    public function occurredAt(): \DateTimeImmutable
    {
        return $this->game->createdAt();
    }

    /**
     * Return event data as array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'gameId' => (string) $this->game->id(),
            'createdAt' => $this->game->createdAt()->format(\DateTimeImmutable::ATOM)
        ];
    }

    /**
     * Get event name
     *
     * @return string
     */
    public function name(): string
    {
        return GameCreated::class;
    }
}
