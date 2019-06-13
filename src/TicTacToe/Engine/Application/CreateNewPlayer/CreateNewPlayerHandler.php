<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Application\CreateNewPlayer;

use TicTacToe\Engine\Domain\Model\Player\Player;
use TicTacToe\Engine\Domain\Model\Player\PlayerRepository;
use TicTacToe\Shared\Application\Command;
use TicTacToe\Shared\Application\CommandHandler;
use TicTacToe\Shared\Application\DataTransformer;

final class CreateNewPlayerHandler implements CommandHandler
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
        return CreateNewPlayerCommand::class;
    }

    /**
     * @inheritDoc
     */
    public function handle(Command $command): DataTransformer
    {
        $player = Player::createPlayerWithToken($command->name(), $command->token());

        $this->playerRepository->add($player);

        return new CreateNewPlayerResponseDto($player);
    }
}
