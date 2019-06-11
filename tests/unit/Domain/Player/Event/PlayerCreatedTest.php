<?php

declare(strict_types = 1);

use TicTacToe\Domain\Player\Event\PlayerCreated;
use TicTacToe\Domain\Player\Player;

class PlayerCreatedTest extends \PHPUnit\Framework\TestCase
{
    public function testItExposesCorrectData()
    {
        $player = $this->createPlayerX();
        $event = new PlayerCreated($player);

        self::assertEquals($player->createdAt()->getTimestamp(), $event->occurredAt()->getTimestamp());

        $payload = $event->toArray();
        self::assertEquals(PlayerCreated::class, $event->name());

        self::assertArrayHasKey('playerId', $payload);
        self::assertEquals((string) $player->id(), $payload['playerId']);

        self::assertArrayHasKey('playerName', $payload);
        self::assertEquals($player->name(), $payload['playerName']);

        self::assertArrayHasKey('playerToken', $payload);
        self::assertEquals($player->playingToken(), $payload['playerToken']);
    }

    public function createPlayerX($name = 'foobar')
    {
        $player = Player::createPlayerWithTokenX($name);

        return $player;
    }
}
