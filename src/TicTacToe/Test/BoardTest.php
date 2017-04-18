<?php

namespace TicTacToe\Test;

use TicTacToe\Board;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    public function testisValidMoveReturnTrue()
    {
        $board = new Board();

        $this->assertTrue($board->isValidMove(1));
    }

    public function testSetBoardInvalidMove()
    {
        $board = new Board();

        try {
            $board->setBoardCell(1, 'x');
            $board->setBoardCell(1, 'o');
        } catch (\Exception $e) {
            $this->assertInstanceOf(\LogicException::class, $e);
        }
    }

    public function testSetBoardThrowsOutOfRangeException()
    {
        $board = new Board();

        try {
            $board->setBoardCell(10, 'x');
        } catch (\Exception $e) {
            $this->assertInstanceOf(\OutOfRangeException::class, $e);
        }
    }

    public function testCellHasValueTrue()
    {
        $board = new Board();
        $board->setBoardCell(1, 'x');
        $this->assertTrue($board->cellHasValue(1));
    }

    public function testCheckForWinnerTrue()
    {
        $board = new Board();

        $board->setBoardCell(1, 'x');
        $board->setBoardCell(2, 'x');
        $board->setBoardCell(3, 'x');

        $this->assertEquals('x', $board->checkForWinner());
    }

    public function testCheckForWinnerNoWinner()
    {
        $board = new Board();

        $board->setBoardCell(1, 'x');
        $board->setBoardCell(2, 'x');
        $board->setBoardCell(9, 'x');

        $this->assertEquals(null, $board->checkForWinner());
    }

    public function testGetBoardSize()
    {
        $board = new Board();

        $this->assertEquals(3, $board->getBoardSize());
    }

    public function testGetBoardWithEmptyCells()
    {
        $board = new Board();
        $boardPlan = $board->getBoard();

        $expected = array(
            "   |   |   ",
            "---|---|---",
            "   |   |   ",
            "---|---|---",
            "   |   |   ",
        );
        $this->assertEquals($expected, $boardPlan);
    }

    public function testGetDemoBoard()
    {
        $board = new Board();
        $boardPlan = $board->demoBoard();

        $expected = array(
            " 1 | 2 | 3 ",
            "---|---|---",
            " 4 | 5 | 6 ",
            "---|---|---",
            " 7 | 8 | 9 ",
        );

        $this->assertEquals($expected, $boardPlan);
    }

    public function testAreAllCellsFilledTrue()
    {
        $board = new Board();
        foreach ($this->fillBoardNoWin() as $input) {
            $board->setBoardCell($input[0], $input[1]);
        }

        $this->assertTrue($board->areAllCellsFilled());
    }

    public function testAreAllCellsFilledFalse()
    {
        $board = new Board();
        foreach ($this->fillBoard() as $input) {
            $board->setBoardCell($input[0], $input[1]);
        }

        $this->assertFalse($board->areAllCellsFilled());
    }

    public function testGetCellValueNotEmpty()
    {
        $board = new Board();
        $board->setBoardCell(1, 'x');

        $this->assertEquals('x', $board->getCellValue(1));
    }

    public function testGetCellValueEmpty()
    {
        $board = new Board();

        $this->assertNull($board->getCellValue(1));
    }

    public function fillBoardNoWin()
    {
        return array(
            array(1, 'x'),
            array(2, 'o'),
            array(3, 'x'),
            array(4, 'o'),
            array(5, 'x'),
            array(6, 'o'),
            array(7, 'o'),
            array(8, 'x'),
            array(9, 'o')
        );
    }

    public function fillBoard()
    {
        return array(
            array(1, 'x'),
            array(2, 'o'),
            array(3, 'x'),
            array(4, 'o'),
            array(5, 'x'),
            array(6, 'o'),
            array(7, 'o'),
            array(8, 'x'),
        );
    }
}
