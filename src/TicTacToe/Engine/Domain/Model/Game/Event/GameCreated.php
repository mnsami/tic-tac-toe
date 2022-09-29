<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Domain\Model\Game\Event;

use TicTacToe\Engine\Domain\Model\Game\Game;
use TicTacToe\Shared\Domain\Model\Event;

final class GameCreated implements Event
{
    private Game $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    /**
     * @inheritDoc
     */
    public function occurredAt(): \DateTimeImmutable
    {
        return $this->game->createdAt();
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'gameId' => (string) $this->game->id(),
            'createdAt' => $this->game->createdAt()->format(\DateTimeImmutable::ATOM)
        ];
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return GameCreated::class;
    }
}
