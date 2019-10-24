<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Domain\Model\Board;

use TicTacToe\Engine\Domain\Model\Board\Exception\SorryBoardSizeIsNotValid;

final class Board
{
    private const BOARD_SIZE_3 = 3;

    /** @var CellSet */
    private $cellSet;

    /** @var int */
    private $size;

    public function __construct(int $size)
    {
        if ($size != self::BOARD_SIZE_3) {
            throw new SorryBoardSizeIsNotValid("Only allowed size for board is: " . self::BOARD_SIZE_3);
        }

        $this->size = $size;
        $this->initBoard();
    }

    public function size(): int
    {
        return $this->size;
    }

    private function initBoard()
    {
        foreach (Position::positions() as $position) {
            $this->cellSet[$position] = Cell::empty();
        }
    }

    public function isFull(): bool
    {
        /** @var Cell $cell */
        foreach ($this->cellSet as $cell) {
            if ($cell->isEmpty()) {
                return false;
            }
        }

        return true;
    }

    public function setCell(Position $position, Cell $cell): Board
    {
        $this->cellSet[$position->position()] = $cell;
    }

    public static function create3By3Board(): Board
    {
        return new self(
            self::BOARD_SIZE_3
        );
    }
}
