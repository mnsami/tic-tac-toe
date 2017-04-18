<?php

namespace TicTacToe;

class Board
{
    /**
     * Board size
     *
     * @const integer
     */
    const BOARD_SIZE = 3;

    /**
     * Default cell value
     *
     * @const string
     */
    const EMPTY_CELL = " ";

    /**
     * Winning combos
     *
     * @const array
     */
    const WINNING_COMBOS = array(
        array(1, 2, 3),
        array(4, 5, 6),
        array(7, 8, 9),
        array(1, 4, 7),
        array(2, 5, 8),
        array(3, 6, 9),
        array(1, 5, 9),
        array(3, 5, 7)
    );

    const LOCATION_MAP = array(
        1 => array(0,0),
        2 => array(1,0),
        3 => array(2,0),
        4 => array(0,1),
        5 => array(1,1),
        6 => array(2,1),
        7 => array(0,2),
        8 => array(1,2),
        9 => array(2,2)
    );

    /**
     * Cell separator in the x direction
     *
     * @var string
     */
    protected $xSeparator = '|';

    /**
     * Cell separator in the y direction
     *
     * @var string
     */
    protected $ySeparator = "-";

    /**
     * Board cells
     *
     * @var array
     */
    protected $boardCells = array();

    /**
     * Number of filled cells
     *
     * @var integer
     */
    private $filledCellsCount = 0;

    /**
     * Number of Board tiles
     * xTiles
     *
     * @var integer
     */
    protected $xTiles;

    /**
     * Number of Board tiles
     * yTiles
     *
     * @var integer
     */
    protected $yTiles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->xTiles = $this->yTiles = self::BOARD_SIZE;
        $this->initBoard();
    }

    /**
     * Initialize the board cells to empty value
     *
     * @return void
     */
    public function initBoard()
    {
        for ($y = 0; $y < $this->yTiles; $y++) {
            for ($x = 0; $x < $this->xTiles; $x++) {
                $this->boardCells[$x][$y] = self::EMPTY_CELL;
            }
        }
    }

    /**
     * Get the board size
     *
     * @return integer board size
     */
    public function getBoardSize()
    {
        return self::BOARD_SIZE;
    }

    /**
     * Draw the board
     *
     * @return string board
     */
    public function getBoard()
    {
        $row = "";
        $boardPlan = array();

        for ($y = 0; $y < $this->yTiles; $y++) {
            $row = "";
            for ($x = 0; $x < $this->xTiles; $x++) {
                $row .= " " . $this->boardCells[$x][$y] . " ";
                if ($x < ($this->xTiles - 1)) {
                    $row .= $this->xSeparator;
                }
            }

            $boardPlan[] = $row;
            if ($y < ($this->yTiles - 1)) {
                $boardPlan[] = $this->drawSeparatorRow($row);
            }
        }

        return $boardPlan;
    }

    /**
     * Return the tic-tac-toe baord just for demo.
     *
     * @return array
     */
    public function demoBoard()
    {
        $row = "";
        $boardPlan = array();
        $markers = array('x', 'o');
        $flip = 0;
        $cellIdx = 1;

        for ($y = 0; $y < $this->yTiles; $y++) {
            $row = "";
            for ($x = 0; $x < $this->xTiles; $x++) {
                $marker = $flip % count($markers);
                $row .= " " . "$cellIdx" . " ";
                $flip++;
                if ($x < ($this->xTiles - 1)) {
                    $row .= $this->xSeparator;
                }
                $cellIdx++;
            }

            $boardPlan[] = $row;
            if ($y < ($this->yTiles - 1)) {
                $boardPlan[] = $this->drawSeparatorRow($row);
            }
        }

        return $boardPlan;
    }

    /**
     * Draw the separator row.
     *
     * @param array $cellsRow row cells.
     *
     * @return string row
     */
    protected function drawSeparatorRow($cellsRow)
    {
        $row = "";
        $cells = explode($this->xSeparator, $cellsRow);
        foreach ($cells as $idx => $cell) {
            $row .= str_repeat($this->ySeparator, strlen($cell));
            if ($idx < (self::BOARD_SIZE - 1)) {
                $row .= $this->xSeparator;
            }
        }

        return $row ;
    }

    /**
     * Check if there is winner
     *
     * @return string marker which won, null if none
     */
    public function checkForWinner()
    {
        $winningMarker = "";
        foreach (self::WINNING_COMBOS as $winningCombo) {
            $winningMarker = "";
            foreach ($winningCombo as $cell) {
                $cell = self::LOCATION_MAP[$cell];
                if (isset($this->boardCells[$cell[0]][$cell[1]])) {
                    $winningMarker .= trim($this->boardCells[$cell[0]][$cell[1]]) . ",";
                }
            }
            $winningMarker = trim($winningMarker, ",");
            $winningMarker = explode(",", $winningMarker);
            if (count($winningMarker) < 3) {
                continue;
            }
            if ($winningMarker[0] === $winningMarker[1]
                && $winningMarker[1] === $winningMarker[2]
                && $winningMarker[2] === $winningMarker[0]
            ) {
                return $winningMarker[0];
            }
        }

        return null;
    }

    /**
     * Set a cell in the board with a marker
     *
     * @param integer $location Cell index
     * @param string  $marker   tic-tac-toe marker
     *
     * @throws \InvalidArgumentException in case of invalid move
     *
     * @return void
     */
    public function setBoardCell($location, $marker)
    {
        if ($this->isValidMove($location)) {
            $cell = self::LOCATION_MAP[$location];
            $this->boardCells[$cell[0]][$cell[1]] = $marker;
            $this->filledCellsCount++;
        }
    }

    /**
     * Check if all board cells are filled with markers
     *
     * @return true in case of all cells filled, false otherwise
     */
    public function areAllCellsFilled()
    {
        return ((self::BOARD_SIZE * self::BOARD_SIZE) == $this->filledCellsCount);
    }

    /**
     * Check if the indicated move is a valid move or not.
     *
     * @param integer $location Cell index
     *
     * @return true in case of valid move, else throws exception
     */
    public function isValidMove($location)
    {
        if (!$this->isInBoard($location)) {
            throw new \OutOfRangeException("Location you indicated ($location) is out of the board bounds. Try again!");
        }

        if ($this->cellHasValue($location)) {
            throw new \LogicException("Location you {$location} indicated already has marker. Try again!");
        }

        return true;
    }

    /**
     * Check if the indicated move is within the board boundaries.
     *
     * @param integer $location Cell index
     *
     * @return true in case of inside the board, else false
     */
    protected function isInBoard($location)
    {
        if ($location < 1 || $location > count(self::LOCATION_MAP)) {
            return false;
        }

        return true;
    }

    /**
     * Check if the indicated location is already set
     *
     * @param integer $location Cell index
     *
     * @return true if cell has value, else false
     */
    public function cellHasValue($location)
    {
        if ($this->isInBoard($location)) {
            $cell = self::LOCATION_MAP[$location];
            if (self::EMPTY_CELL != $this->boardCells[$cell[0]][$cell[1]]) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return board cell value
     *
     * @param integer $location Cell index
     *
     * @return string
     */
    public function getCellValue($location)
    {
        if ($this->isInBoard($location)) {
            $cell = self::LOCATION_MAP[$location];
            if (self::EMPTY_CELL != $this->boardCells[$cell[0]][$cell[1]]) {
                return $this->boardCells[$cell[0]][$cell[1]];
            }
        }

        return null;
    }
}
