<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use TicTacToe\Engine\Domain\Model\Player\Exception\SorryPlayerNameIsTooLong;
use TicTacToe\Engine\Domain\Model\Player\Exception\SorryPlayerNameIsTooShort;
use TicTacToe\Engine\Domain\Model\Player\Player;
use TicTacToe\Engine\Domain\Model\Player\PlayerId;

class PlayerTest extends TestCase
{
    public function testPlayerCreatedSuccessfully()
    {
        $player = Player::createPlayerWithTokenX(
            "mina"
        );

        self::assertEquals("mina", $player->name());
        self::assertEquals('x', $player->playingToken());
        self::assertInstanceOf(PlayerId::class, $player->id());
    }

    public function testPlayerCreatedWithPlayingTokenXSuccessfully()
    {
        $player = Player::createPlayerWithTokenX("mina");

        self::assertEquals("mina", $player->name());
        self::assertEquals('x', $player->playingToken());
        self::assertInstanceOf(PlayerId::class, $player->id());
        self::assertNotNull($player->id());
    }

    public function testPlayerCreatedWithPlayingTokenYSuccessfully()
    {
        $player = Player::createPlayerWithTokenY("mina");

        self::assertEquals("mina", $player->name());
        self::assertEquals('y', $player->playingToken());
        self::assertInstanceOf(PlayerId::class, $player->id());
        self::assertNotNull($player->id());
    }

    public function testItThrowsExceptionIfPlayerNameIsShort()
    {
        self::expectException(SorryPlayerNameIsTooShort::class);
        Player::createPlayerWithTokenX("m");
    }

    public function testItThrowsExceptionIfPlayerNameIsLong()
    {
        self::expectException(SorryPlayerNameIsTooLong::class);
        Player::createPlayerWithTokenX("FGLAHETLDGHAELTRHG53Y693576935sfkhglkshfgshfgkfkgherg53yt3589gh358gh359hg395gh395");
    }
}
