<?php

namespace TicTacToe\Test;

use TicTacToe\Player\HumanPlayer;
use PHPUnit\Framework\TestCase;

class HumanPlayerTest extends TestCase 
{
    public function testGetNameWhenNameIsProvided()
    {
        $player = new HumanPlayer('x', 'mina');

        $this->assertEquals('mina', $player->getName());
        $this->assertEquals('x', $player->getMarker());
    }

    public function testGetNameWhenNameIsNotProvided()
    {
        $player = new HumanPlayer('x');

        $this->assertEquals('Player_x', $player->getName());
        $this->assertEquals('x', $player->getMarker());
    }

    public function testIsAllowedMarkerWithInvalidMarker()
    {
        try {
            $player = new HumanPlayer('1');
        } catch (\Exception $e) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $e);
        }
    }
}

