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
        $cell = new Cell('x');
        self::assertEquals('x', (string) $cell);
    }

    public function testItCanCreateEmptyCell()
    {
        $cell = Cell::empty();
        self::assertEquals('', (string) $cell);
    }

    public function testItCanCreateCellFromPlayerToken()
    {
        $playerToken = PlayerToken::createGameTokenX();

        $cell = Cell::createFromPlayerToken($playerToken);
        self::assertEquals('x', (string) $cell);
    }
}
