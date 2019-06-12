<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Application\CreatePlayer;

use TicTacToe\Engine\Domain\Model\Player\Player;
use TicTacToe\Engine\Domain\Model\Player\PlayerRepository;
use TicTacToe\Shared\Application\Command;
use TicTacToe\Shared\Application\CommandHandler;
use TicTacToe\Shared\Application\DataTransformer;

final class CreatePlayerHandler implements CommandHandler
{
    /** @var PlayerRepository */
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    /**
     * @inheritDoc
     */
    public function handles(): string
    {
        return CreatePlayerCommand::class;
    }

    /**
     * @inheritDoc
     */
    public function handle(Command $command): DataTransformer
    {
        $player = Player::createPlayerWithToken($command->name(), $command->token());

        $this->playerRepository->add($player);

        return new CreatePlayerDto($player);
    }
}
