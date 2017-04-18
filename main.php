<?php

require "./vendor/autoload.php";

use TicTacToe\Application;
use TicTacToe\IO\IOHandler;

$game = new Application(new IOHandler());
$game->run();
