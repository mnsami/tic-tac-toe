<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use TicTacToe\Domain\Player\Exception\SorryInvalidPlayerToken;
use TicTacToe\Domain\Player\PlayerToken;

class PlayerTokenTest extends TestCase
{
    public function testItCreatePlayerTokenXSuccessfull()
    {
        $token = PlayerToken::createGameTokenX();

        self::assertEquals('x', (string) $token);
    }

    public function testItCreatePlayerTokenYSuccessfull()
    {
        $token = PlayerToken::createGameTokenY();

        self::assertEquals('y', (string) $token);
    }

    public function testItThrowsSorryInvalidPlayerTokenWhenTokenIsInvalid()
    {
        self::expectException(SorryInvalidPlayerToken::class);
        $token = new PlayerToken('zz');
    }
}