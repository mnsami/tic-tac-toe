<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Domain\Model\Player;

use Traversable;

class PlayerIdSet implements \Countable, \IteratorAggregate
{
    /** @var PlayerId[] */
    private $playerIds;

    public function __construct(PlayerId ...$playerIds)
    {
        if (empty($playerIds)) {
            throw new \InvalidArgumentException('Player Id set cannot be empty');
        }

        $this->playerIds = $playerIds;
    }

    /**
     * @return array|PlayerId[]
     */
    public function toArray(): array
    {
        return $this->playerIds;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->toArray());
    }

    public function count()
    {
        return count($this->playerIds);
    }
}
