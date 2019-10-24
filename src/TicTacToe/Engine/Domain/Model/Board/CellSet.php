<?php
declare(strict_types=1);

namespace TicTacToe\Engine\Domain\Model\Board;

use Traversable;

final class CellSet implements \Countable, \IteratorAggregate
{
    /** @var Cell[] */
    private $cells;

    public function __construct(Cell ...$cells)
    {
        if (empty($cells)) {
            throw new \InvalidArgumentException('Cell can not be empty.');
        }

        $this->cells = $cells;
    }

    public function toArray(): array
    {
        return $this->cells;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->toArray());
    }

    public function count()
    {
        return count($this->cells);
    }
}
