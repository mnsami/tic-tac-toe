<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use TicTacToe\Engine\Domain\Model\Player\Player;
use TicTacToe\Engine\Domain\Model\Player\PlayerId;
use TicTacToe\Engine\Domain\Model\Player\PlayerRepository;
use TicTacToe\Engine\Infrastructure\Persistence\InMemory\InMemoryPlayerRepository;

class InMemoryPlayerRepositoryTest extends TestCase
{
    /** @var PlayerRepository */
    private $repository;

    protected function setUp()
    {
        $this->repository = new InMemoryPlayerRepository();
    }

    public function testItCanSaveAndGetPlayerByIdentity()
    {
        $player = $this->createPlayer();

        $this->repository->add($player);

        self::assertEquals(1, count($this->repository->players()));

        $retrievedPlayer = $this->repository->ofId($player->id());
        self::assertEquals($player->id(), $retrievedPlayer->id());
        self::assertEquals($player->name(), $retrievedPlayer->name());
        self::assertEquals($player->playingToken(), $retrievedPlayer->playingToken());
    }

    public function testItGenerateNextIdentity()
    {
        $nextId = $this->repository->nextIdentity();

        self::assertInstanceOf(PlayerId::class, $nextId);
        self::assertTrue(Uuid::isValid((string) $nextId));
    }

    protected function createPlayer(string $name = 'foobar')
    {
        $player = Player::createPlayerWithTokenX($name);

        return $player;
    }
}
