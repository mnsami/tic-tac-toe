<?php

declare(strict_types = 1);

namespace unit\TicTacToe\Engine\Domain\Model\Board;

use PHPUnit\Framework\TestCase;
use TicTacToe\Engine\Domain\Model\Board\Cell;
use TicTacToe\Engine\Domain\Model\Player\PlayerToken;

class CellTest extends TestCase
{
    public function testCellCreatedSuccessfully()
    {
        $cell = new Cell(PlayerToken::createGameTokenX());
        self::assertEquals('x', (string) $cell);
    }
}
