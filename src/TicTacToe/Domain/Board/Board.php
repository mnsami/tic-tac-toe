<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Board;

use TicTacToe\Domain\Board\Exception\SorryBoardSizeIsNotValid;

final class Board
{
    private const BOARD_SIZE_3 = 3;

    /** @var [][] */
    private $cellSet;

    /** @var int */
    private $size;

    public function __construct(int $size)
    {
        if ($size != self::BOARD_SIZE_3) {
            throw new SorryBoardSizeIsNotValid("Only allowed size for now is: " . self::BOARD_SIZE_3);
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
        foreach (range(0, $this->size - 1) as $row) {
            foreach (range(0, $this->size - 1) as $col) {
                $this->cellSet[$row][$col] = Cell::empty();
            }
        }
    }

    public static function create3By3Board(): Board
    {
        return new self(
            self::BOARD_SIZE_3
        );
    }
}
