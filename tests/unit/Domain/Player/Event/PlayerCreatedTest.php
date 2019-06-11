<?php

declare(strict_types = 1);

use TicTacToe\Domain\Player\Event\PlayerCreated;
use TicTacToe\Domain\Player\Player;

class PlayerCreatedTest extends \PHPUnit\Framework\TestCase
{
    public function testItExposesCorrectData()
    {
        $player = $this->createPlayer();
        $event = new PlayerCreated($player);

        self::assertEquals($player->createdAt()->getTimestamp(), $event->occurredAt()->getTimestamp());

        $payload = $event->toArray();
        self::assertArrayHasKey('playerId', $payload);
        self::assertArrayHasKey('playerName', $payload);
        self::assertArrayHasKey('playerToken', $payload);
    }

    public function createPlayer($name = 'foobar')
    {
        $player = Player::createPlayerWithTokenX($name);

        return $player;
    }
}
