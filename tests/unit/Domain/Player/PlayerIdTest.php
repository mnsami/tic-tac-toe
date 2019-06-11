<?php

declare(strict_types = 1);

use Ramsey\Uuid\Uuid;
use TicTacToe\Domain\Player\PlayerId;

class PlayerIdTest extends \PHPUnit\Framework\TestCase
{
    public function testItCreateSuccessWithUUID4IfNothingPassed()
    {
        $playerId = new PlayerId();

        self::assertNotNull($playerId);
        self::assertTrue(Uuid::isValid((string) $playerId));
    }

    public function testItCreateSuccessfully()
    {
        $playerId = new PlayerId('1');

        self::assertNotNull($playerId);
        self::assertEquals('1', (string) $playerId);
    }
}
