<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Infrastructure\Persistence\InMemory;

use TicTacToe\Engine\Domain\Model\Game\Game;
use TicTacToe\Engine\Domain\Model\Game\GameId;
use TicTacToe\Engine\Domain\Model\Game\GameRepository;

class InMemoryGameRepository implements GameRepository
{
    /** @var Game[] */
    private $games = [];
    /**
     * @param Game $game
     * @return void
     */
    public function add(Game $game): void
    {
        $this->games[(string) $game->id()] = $game;
    }

    /**
     * @param GameId $gameId
     * @return Game|null
     */
    public function ofId(GameId $gameId): ?Game
    {
        if (!isset($this->games[(string) $gameId])) {
            return null;
        }

        return $this->games[(string) $gameId];
    }

    /**
     * @return GameId
     */
    public function nextIdentity(): GameId
    {
        return new GameId();
    }

    /**
     * @return array
     */
    public function games(): array
    {
        return $this->games;
    }
}
