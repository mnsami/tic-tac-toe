<?php

declare(strict_types = 1);

namespace TicTacToe\Application\Player;

use TicTacToe\Domain\Player\Player;
use TicTacToe\Domain\Player\PlayerRepository;
use TicTacToe\Domain\Shared\CommandHandler;

final class CreatePlayerHandler implements CommandHandler
{
    /** @var PlayerRepository */
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function __invoke(CreatePlayerCommand $command)
    {
        $player = Player::createPlayerWithToken($command->name(), $command->token());

        $this->playerRepository->add($player);

        return $player;
    }

    /**
     * @inheritDoc
     */
    public function handles(): string
    {
        return CreatePlayerCommand::class;
    }
}
