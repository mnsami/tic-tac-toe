<?php

declare(strict_types = 1);

namespace TicTacToe\Application\Player;

use TicTacToe\Domain\Player\Player;
use TicTacToe\Domain\Player\PlayerRepository;

final class CreatePlayerHandler
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
}
