<?php

namespace TicTacToe;

use TicTacToe\Board;
use TicTacToe\IO\IOHandler;
use TicTacToe\Player\HumanPlayer;

class Application
{
    /**
     * Maximum players for this game
     *
     * @const integer
     */
    const MAX_PLAYERS = 2;

    /**
     * String padding lenght used to show
     * test in cli
     *
     * @const integer
     */
    const STRING_PADDING_LENGTH = 64;

    /**
     * Board instance
     *
     * @var Board
     */
    protected $board = null;

    /**
     * IOHandler for handling
     * input from STDIN
     * and output to STDOUT
     *
     * @var IOHandler
     */
    protected $ioHandler = null;

    /**
     * Array of players
     *
     * @var array
     */
    protected $players;

    /**
     * Boolean if players choose to start game
     *
     * @var bool
     */
    protected $isStarted = false;

    protected $playerTurn = 0;
    protected $moves = 0;

    /**
     * Constructor
     */
    public function __construct(IOHandler $ioHandler)
    {
        $this->board = new Board();
        $this->players = array();
        $this->ioHandler = $ioHandler;
    }

    /**
     * Process user key press input
     *
     * @return void
     */
    protected function processInput()
    {
        $keyPressed = $this->ioHandler->readString(true);

        switch ($keyPressed) {
            case 'd':
            case 'D':
                $this->ioHandler->writeLine($this->board->getBoard());
                break;
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
                return $keyPressed;
                break;
            case 's':
            case 'S':
                // check in players
                if (!$this->isStarted) {
                    $this->checkInPlayers();
                }
                break;
            default:
                $this->ioHandler->writeLine("Unidentified input.", IOHandler::WARNING);
                break;
        }
    }

    /**
     * Is game started
     *
     * @return bool
     */
    public function isGameStarted()
    {
        return $this->isStarted;
    }

    public function getMovesCount()
    {
        return $this->moves;
    }


    public function getCellValue($location)
    {
        return $this->board->getCellValue($location);
    }

    /**
     * Run the game
     *
     * @codeCoverageIgnore
     *
     * @return void
     */
    public function run()
    {
        $this->showWelcome();

        while (($winner = $this->board->checkForWinner()) == null) {
            if (!$this->isStarted) {
                $this->processInput();
            } else {
                try {
                    $this->nextStep();

                    if ($this->isGameDraw()) {
                        $this->gameIsDraw();
                        break;
                    }
                } catch (\Exception $e) {
                    $this->ioHandler->writeLine($e->getMessage(), IOHandler::ERROR);
                    continue;
                }
            }
        }

        if (!empty($winner)) {
            $this->gameHasWinner($winner);
        }
    }

    /**
     * Check if game is draw between players
     *
     * @return void
     */
    protected function isGameDraw()
    {
        return ((true == $this->board->areAllCellsFilled()) && (null == $this->board->checkForWinner()));
    }

    /**
     * Show winner
     *
     * @param string $marker Winner marker
     *
     * @return void
     */
    protected function gameHasWinner($marker)
    {
        $winner = $this->getPlayerByMarker($marker);
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding("#", "#"), IOHandler::SUCCESS);
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding(" ", " "), IOHandler::SUCCESS);
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding("Hoorrraaayyy !"), IOHandler::SUCCESS);
        $this->ioHandler->writeLine(
            $this->getBorderedStringWithPadding($winner->getName() . " won!"),
            IOHandler::SUCCESS
        );

        foreach ($this->board->getBoard() as $boardRow) {
            $this->ioHandler->writeLine($this->getBorderedStringWithPadding($boardRow), IOHandler::SUCCESS);
        }
        $this->ioHandler->writeLine(
            $this->getBorderedStringWithPadding("Thank you for playing Tic-Tac-Toe"),
            IOHandler::SUCCESS
        );
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding(" ", " "), IOHandler::SUCCESS);
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding("#", "#"), IOHandler::SUCCESS);
    }

    /**
     * Game is ended with draw
     *
     * @return void
     */
    protected function gameIsDraw()
    {
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding("#", "#"));
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding(" ", " "));
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding("It is a DRAW!"));
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding("Thank you for playing Tic-Tac-Toe."));
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding(" ", " "));
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding("#", "#"));
    }

    /**
     * Play
     *
     * @return void
     */
    private function nextStep()
    {
        $this->playerTurn = $this->moves % count($this->players);
        $player = $this->players[$this->playerTurn];

        $this->ioHandler->write("{$player->getName()}'s turn, please enter the location: ");
        $location = $this->processInput();

        if ($location) {
            $this->board->setBoardCell($location, $player->getMarker());
            $this->moves++;
        }
    }

    /**
     * Show the welcome message
     *
     * @return void
     */
    protected function showWelcome()
    {
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding("#", "#"));
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding(" ", " "));
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding("Tic-Tac-Toe Game"));
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding(" ", " "));
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding("#", "#"));
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding("Welcome to Tic-Tac-Toe"));
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding(" ", " "));
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding("This is a two players tic-tac-toe game."));
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding(" ", " "));
        foreach ($this->board->demoBoard() as $boardRow) {
            $this->ioHandler->writeLine($this->getBorderedStringWithPadding($boardRow));
        }
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding(" ", " "));
        $this->ioHandler->writeLine("| To start playing you need to press 's/S', then enter players   |");
        $this->ioHandler->writeLine("| details (name and marker). If at anytime you want to draw the  |");
        $this->ioHandler->writeLine("| board press 'd/D'.                                             |");
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding(" ", " "));
        $this->ioHandler->writeLine("| Enjoy!                                                         |");
        $this->ioHandler->writeLine($this->getBorderedStringWithPadding("_", "_"));
        $this->ioHandler->writeLine();
        $this->ioHandler->write("Press 's/S' to start the game... ", IOHandler::LIGHT_CYAN);
    }

    /**
     * Prompt to make players enter their name and
     * choose their markers.
     *
     * @return void
     */
    public function checkInPlayers()
    {
        $this->isStarted = true;
        $playersCheckedIn = 0;
        $player = array(
            'name' => null,
            'marker' => null
        );
        while ($playersCheckedIn < self::MAX_PLAYERS) {
            try {
                if (!isset($player['name'])) {
                    $this->ioHandler->write("What is the name of Player " . ($playersCheckedIn + 1) . ": ");
                    $player['name'] = $this->ioHandler->readString();
                }

                if (!isset($player['marker'])) {
                    $this->ioHandler->write("Please choose your Tic-Tac-Toe marker i.e. 'x', 'o': ");
                    $marker = $this->ioHandler->readString(true);
                    if (!$this->isMarkerTaken($marker)) {
                        $this->players[] = new HumanPlayer($marker, $player['name']);
                        $player['marker'] = $marker;
                    }
                }
            } catch (\Exception $e) {
                $this->ioHandler->writeLine($e->getMessage(), IOHandler::ERROR);
                continue;
            }

            $playersCheckedIn++;
            unset($player);
        }
    }

    /**
     * Get players
     *
     * @return array
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Get Player by marker
     *
     * @return TicTacToe\Player\HumanPlayer
     */
    protected function getPlayerByMarker($marker)
    {
        foreach ($this->players as $player) {
            if ($marker === $player->getMarker()) {
                return $player;
            }
        }

        return null;
    }

    /**
     * Check if marker is already chosen
     * by another player.
     *
     * @param string $marker marker to check
     *
     * @throws \RuntimeException in case of marker already taken
     * @return true if not taken, false otherwise
     */
    private function isMarkerTaken($marker)
    {
        foreach ($this->players as $player) {
            if ($marker === $player->getMarker()) {
                throw new \RuntimeException("Sorry! '{$marker}' is already taken.");
            }
        }

        return false;
    }

    /**
     * Get a RIGHT and LEFT padded string with
     * left and right border.
     *
     * @param string $string String to output
     * @param string $padding Optional. Specifies the string to use for padding. Default is whitespace
     *
     * @return string
     */
    private function getBorderedStringWithPadding($string, $padding = " ")
    {
        return "|" . $this->getPaddedStringForOutput($string, $padding) . "|";
    }

    /**
     * Get a RIGHT and LEFT padded string used
     * in showing Welcome, Game draw and Game win
     *
     * @param string $string String to output
     * @param string $padding Optional. Specifies the string to use for padding. Default is whitespace
     *
     * @return string
     */
    private function getPaddedStringForOutput($string, $padding = " ")
    {
        return str_pad($string, self::STRING_PADDING_LENGTH, $padding, STR_PAD_BOTH);
    }
}
