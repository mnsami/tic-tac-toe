<?php

namespace TicTacToe\Player;

abstract class Player implements PlayerInterface
{
    protected $name;

    protected $marker;

    protected $allowedMarkers = array('x', 'o');

    public function __construct($marker, $name = null)
    {
        if ($this->isAllowedMarker($marker)) {
            $this->marker = $marker;
        }

        if (empty($name)) {
            $this->name = "Player_" . $marker;
        } else {
            $this->name = $name;
        }

        $this->marker = $marker;
    }

    /**
     * Checks if the player choose 'x' or 'o' as
     * his/her marker.
     *
     * @param char $marker Makrer player chose
     *
     * @return true if yes false otherwise
     */
    protected function isAllowedMarker($marker)
    {
        if (in_array(strtolower($marker), $this->allowedMarkers)) {
            return true;
        }

        throw new \InvalidArgumentException("Only 'x' or 'y' are allowed as markers.");
    }

    public function getName()
    {
        return $this->name;
    }

    public function getMarker()
    {
        return $this->marker;
    }
}
