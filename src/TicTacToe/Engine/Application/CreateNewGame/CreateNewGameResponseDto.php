<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Application\CreateNewGame;

use TicTacToe\Engine\Domain\Model\Game\Game;
use TicTacToe\Engine\Domain\Model\Player\PlayerId;
use TicTacToe\Shared\Application\DataTransformer;

final class CreateNewGameResponseDto implements DataTransformer
{
    private string $gameId;

    private int $boardSize;

    /** @var PlayerId[]  */
    private array $playerIds;

    private \DateTimeImmutable $createdAt;

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

    /**
     * @return PlayerId[]
     */
    public function playerIds(): array
    {
        return $this->playerIds;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return array<string, array<PlayerId>|int|string>
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
