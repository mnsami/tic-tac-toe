<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use TicTacToe\Domain\Player\Exception\SorryPlayerNameIsTooShort;
use TicTacToe\Domain\Player\PlayerName;
use TicTacToe\Domain\Player\Exception\SorryPlayerNameIsTooLong;

class PlayerNameTest extends TestCase
{
    public function testItCreatesPlayerNameSuccessfully()
    {
        $player = new PlayerName("Joe");

        self::assertEquals("Joe", (string) $player);
    }

    public function testItThrowsSorryPlayerNameIsTooShortWhenNameIsTooShort()
    {
        self::expectException(SorryPlayerNameIsTooShort::class);
        new PlayerName("m");
    }

    public function testItThrowsSorryPlayerNameIsTooLongWhenNameIsTooLong()
    {
        self::expectException(SorryPlayerNameIsTooLong::class);
        new PlayerName("mrgwhw46ethsethsethw465yw4 4wyw46h 46hw46hw46hw46hw46h");
    }
}
