<?php

declare(strict_types = 1);

namespace unit\TicTacToe\Engine\Domain\Model\Game;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use TicTacToe\Engine\Domain\Model\Game\GameId;

class GameIdTest extends TestCase
{
    public function testItCreateSuccessWithUUID4IfNothingPassed()
    {
        $gameId = new GameId();

        self::assertNotNull($gameId);
        self::assertTrue(Uuid::isValid((string) $gameId));
    }

    public function testItCreateSuccessfully()
    {
        $gameId = new GameId('1');

        self::assertNotNull($gameId);
        self::assertEquals('1', (string) $gameId);
    }
}
