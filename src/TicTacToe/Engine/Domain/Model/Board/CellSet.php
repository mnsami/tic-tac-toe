<?php
declare(strict_types=1);

namespace TicTacToe\Engine\Domain\Model\Board;

use Iterator;

/**
 * @implements \IteratorAggregate<Cell>
 */
final class CellSet implements \Countable, \IteratorAggregate
{
    /** @var Cell[] */
    private array $cells;

    public function __construct(Cell ...$cells)
    {
        if (empty($cells)) {
            throw new \InvalidArgumentException('Cell can not be empty.');
        }

        $this->cells = $cells;
    }

    /**
     * @return Cell[]
     */
    public function toArray(): array
    {
        return $this->cells;
    }

    public function getIterator(): Iterator
    {
        return new \ArrayIterator($this->toArray());
    }

    public function count(): int
    {
        return count($this->cells);
    }
}
