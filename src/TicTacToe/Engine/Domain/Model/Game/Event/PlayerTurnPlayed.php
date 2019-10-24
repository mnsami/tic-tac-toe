<?php
declare(strict_types=1);

namespace TicTacToe\Engine\Domain\Model\Game\Event;

use TicTacToe\Engine\Domain\Model\Game\Turn;
use TicTacToe\Shared\Domain\Model\Event;

final class PlayerTurnPlayed implements Event
{
    /** @var Turn */
    private $turn;

    public function __construct(Turn $turn)
    {
        $this->turn = $turn;
    }

    /**
     * @inheritDoc
     */
    public function occurredAt(): \DateTimeImmutable
    {
        return $this->turn->createdAt();
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'turnId' => (string) $this->turn->moveId(),
            'madeBy' => (string) $this->turn->madeBy()->id(),
            'position' => $this->turn->position()->position(),
            'createdAt' => $this->turn->createdAt()->format(\DateTimeImmutable::ATOM)
        ];
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return PlayerTurnPlayed::class;
    }
}
