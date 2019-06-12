<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use TicTacToe\Engine\Domain\Model\Player\PlayerId;

class PlayerIdTest extends TestCase
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
