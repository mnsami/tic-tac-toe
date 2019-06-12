<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use TicTacToe\Engine\Domain\Model\Board\Board;
use TicTacToe\Engine\Domain\Model\Board\Exception\SorryBoardSizeIsNotValid;

class BoardTest extends TestCase
{
    public function testBoardCreatedSuccessfully()
    {
        $board = Board::create3By3Board();

        self::assertEquals(3, $board->size());
    }

    public function testItThrowsSorryBoardSizeIsNotValid()
    {
        self::expectException(SorryBoardSizeIsNotValid::class);
        new Board(4);
    }
}
