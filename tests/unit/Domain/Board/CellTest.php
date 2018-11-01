<?php

declare(strict_types = 1);

use TicTacToe\Domain\Board\Cell;
use TicTacToe\Domain\Player\PlayerToken;

class CellTest extends \PHPUnit\Framework\TestCase
{
    public function testCellCreatedSuccessfully()
    {
        $cell = new Cell(PlayerToken::createGameTokenX());
        self::assertEquals('x', (string) $cell);
    }
}
