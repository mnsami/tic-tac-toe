<?php

declare(strict_types = 1);

namespace unit\TicTacToe\Engine\Application\CreateNewPlayer;

use PHPUnit\Framework\TestCase;
use TicTacToe\Engine\Application\CreateNewPlayer\CreateNewPlayerCommand;
use TicTacToe\Engine\Application\CreateNewPlayer\CreateNewPlayerHandler;
use TicTacToe\Engine\Application\CreateNewPlayer\CreateNewPlayerResponseDto;
use TicTacToe\Engine\Domain\Model\Player\PlayerId;
use TicTacToe\Engine\Infrastructure\Persistence\InMemory\InMemoryPlayerRepository;
use TicTacToe\Shared\Application\Exception\SorryWrongCommand;
use unit\TicTacToe\WrongCommand;

class CreateNewPlayerHandlerTest extends TestCase
{
    private CreateNewPlayerHandler $handler;

    private InMemoryPlayerRepository $playerRepository;

    protected function setUp(): void
    {
        $this->playerRepository = new InMemoryPlayerRepository();
        $this->handler = new CreateNewPlayerHandler(
            $this->playerRepository
        );
    }

    public function testItHandlesCorrectClass(): void
    {
        self::assertEquals(CreateNewPlayerCommand::class, $this->handler->handles());
    }

    public function testItCanCreateANewPlayer(): void
    {
        $command = $this->createCommand();

        /** @var CreateNewPlayerResponseDto $playerDto */
        $playerDto = $this->handler->handle($command);
        $retrievedPlayer = $this->playerRepository->ofId(new PlayerId($playerDto->playerId()));
        self::assertEquals($retrievedPlayer->name(), $playerDto->playerName());
        self::assertEquals((string) $retrievedPlayer->playingToken(), $playerDto->playerToken());
    }

    public function testItThrowsSorryWrongCommandWhenWrongCommandPassed(): void
    {
        $command = new WrongCommand();

        self::expectException(SorryWrongCommand::class);
        $this->handler->handle($command);
    }

    private function createCommand(string $name = 'player', string $token = 'x'): CreateNewPlayerCommand
    {
        return new CreateNewPlayerCommand($name, $token);
    }
}
