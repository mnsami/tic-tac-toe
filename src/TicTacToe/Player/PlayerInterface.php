<?php

namespace TicTacToe\Player;

interface PlayerInterface
{
    /**
     * Get Player name
     *
     * @return string
     */
    public function getName();

    /**
     * Get Player marker, either 'x' or 'o'
     *
     * @return char
     */
    public function getMarker();
}
