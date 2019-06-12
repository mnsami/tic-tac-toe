<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Domain\Model\Player;

interface PlayerRepository
{
    /**
     * @param Player $player
     * @return void
     */
    public function add(Player $player);

    /**
     * @param PlayerId $playerId
     *
     * @return null|Player
     */
    public function ofId(PlayerId $playerId): ?Player;

    /**
     * @return PlayerId
     */
    public function nextIdentity(): PlayerId;

    /**
     * @return Player[]
     */
    public function players(): array;
}
