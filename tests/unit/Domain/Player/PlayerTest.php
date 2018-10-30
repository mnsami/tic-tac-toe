<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use TicTacToe\Domain\Player\Player;
use TicTacToe\Domain\Player\PlayerId;
use TicTacToe\Domain\Player\PlayerName;
use TicTacToe\Domain\Player\PlayerToken;

class PlayerTest extends TestCase
{
    public function testPlayerCreatedSuccessfully()
    {
        $player = new Player(
            new PlayerId(),
            new PlayerName("mina"),
            PlayerToken::createGameTokenX()
        );

        self::assertEquals("mina", $player->name());
        self::assertEquals('x', $player->token());
    }


}
