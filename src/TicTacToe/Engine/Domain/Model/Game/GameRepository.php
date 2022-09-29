<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Domain\Model\Game;

interface GameRepository
{
    /**
     * @param Game $game
     * @return void
     */
    public function add(Game $game): void;

    /**
     * @param GameId $gameId
     * @return Game|null
     */
    public function ofId(GameId $gameId): ?Game;

    /**
     * @return GameId
     */
    public function nextIdentity(): GameId;

    /**
     * @return array<string, Game>
     */
    public function games(): array;
}
