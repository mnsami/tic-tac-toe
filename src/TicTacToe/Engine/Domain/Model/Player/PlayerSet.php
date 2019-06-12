<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Model\Player;

use Traversable;

class PlayerSet implements \Countable, \IteratorAggregate
{
    /** @var Player[] */
    private $players;

    public function __construct(Player ...$players)
    {
        if (empty($players)) {
            throw new \InvalidArgumentException('Player set cannot be empty');
        }

        $this->players = $players;
    }

    /**
     * @return array|Player[]
     */
    public function toArray(): array
    {
        return $this->players;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->toArray());
    }

    public function count()
    {
        return count($this->players);
    }
}
