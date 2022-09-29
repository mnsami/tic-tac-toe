<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Domain\Model\Player;

use Iterator;

/**
 * @implements \IteratorAggregate<PlayerId>
 */
class PlayerIdSet implements \Countable, \IteratorAggregate
{
    /** @var PlayerId[] */
    private array $playerIds;

    public function __construct(PlayerId ...$playerIds)
    {
        if (empty($playerIds)) {
            throw new \InvalidArgumentException('Player Id set cannot be empty');
        }

        $this->playerIds = $playerIds;
    }

    /**
     * @return array<int, PlayerId>
     */
    public function toArray(): array
    {
        return $this->playerIds;
    }

    /**
     * @return Iterator<PlayerId>
     */
    public function getIterator(): Iterator
    {
        return new \ArrayIterator($this->toArray());
    }

    public function count(): int
    {
        return count($this->playerIds);
    }
}
