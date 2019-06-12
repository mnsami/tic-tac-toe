<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Application\CreatePlayer;

use TicTacToe\Engine\Domain\Model\Player\Player;
use TicTacToe\Shared\Application\DataTransformer;

final class CreatePlayerDto implements DataTransformer
{
    /** @var string */
    private $playerId;

    /** @var string */
    private $playerToken;

    /** @var string */
    private $playerName;

    public function __construct(Player $player)
    {
        $this->playerId = (string) $player->id();
        $this->playerToken = $player->playingToken();
        $this->playerName = $player->name();
    }

    public function playerId(): string
    {
        return $this->playerId;
    }

    public function playerName(): string
    {
        return $this->playerName;
    }

    public function playerToken(): string
    {
        return $this->playerToken;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'playerId' => $this->playerId,
            'playerName' => $this->playerName,
            'playerToken' => $this->playerToken
        ];
    }
}
