<?php

declare(strict_types = 1);

namespace TicTacToe\Infrastructure\Persistence\InMemory;

use TicTacToe\Domain\Model\Player\Player;
use TicTacToe\Domain\Model\Player\PlayerId;
use TicTacToe\Domain\Model\Player\PlayerRepository;

class InMemoryPlayerRepository implements PlayerRepository
{
    /** @var Player[] */
    private $players = [];

    public function add(Player $player)
    {
        $this->players[(string)$player->id()] = $player;
    }

    public function ofId(PlayerId $playerId): ?Player
    {
        if (!isset($this->players[(string)$playerId->id()])) {
            return null;
        }

        return $this->players[$playerId->id()];
    }

    public function nextIdentity(): PlayerId
    {
        return new PlayerId();
    }

    /**
     * @return Player[]
     */
    public function players(): array
    {
        return $this->players;
    }
}
