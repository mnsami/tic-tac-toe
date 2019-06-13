<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Application\CreateNewGame;

use TicTacToe\Engine\Domain\Model\Game\Game;
use TicTacToe\Shared\Application\DataTransformer;

final class CreateNewGameResponseDto implements DataTransformer
{
    /** @var string */
    private $gameId;

    /** @var int */
    private $boardSize;

    /** @var [] */
    private $playerIds;

    /** @var \DateTimeImmutable */
    private $createdAt;

    public function __construct(Game $game)
    {
        $this->gameId = (string) $game->id();
        $this->boardSize = $game->board()->size();
        $this->playerIds = $game->playerIds()->toArray();
        $this->createdAt = $game->createdAt();
    }

    public function gameId(): string
    {
        return $this->gameId;
    }

    public function boardSize(): int
    {
        return $this->boardSize;
    }

    public function playerIds(): array
    {
        return $this->playerIds;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->gameId,
            'boardSize' => $this->boardSize,
            'playerIds' => $this->playerIds,
            'createdAt' => $this->createdAt->format(\DateTimeImmutable::ATOM)
        ];
    }
}
