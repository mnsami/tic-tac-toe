<?php
declare(strict_types=1);

namespace TicTacToe\Engine\Domain\Model\Game;

interface TurnRepository
{
    /**
     * @param Turn $turn
     */
    public function add(Turn $turn): void;

    /**
     * @param TurnId $id
     * @return Turn|null
     */
    public function ofId(TurnId $id): ?Turn;

    /**
     * @return TurnId
     */
    public function nextIdentity(): TurnId;

    /**
     * @return array
     */
    public function turns(): array;
}
