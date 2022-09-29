<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Application\CreateNewPlayer;

use TicTacToe\Engine\Domain\Model\Player\Player;
use TicTacToe\Shared\Application\DataTransformer;

final class CreateNewPlayerResponseDto implements DataTransformer
{
    private string $playerId;

    private string $playerToken;

    private string $playerName;

    private \DateTimeImmutable $createdAt;

    public function __construct(Player $player)
    {
        $this->playerId = (string) $player->id();
        $this->playerToken = (string) $player->playingToken();
        $this->playerName = $player->name();
        $this->createdAt = $player->createdAt();
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

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->playerId,
            'name' => $this->playerName,
            'token' => $this->playerToken,
            'createdAt' => $this->createdAt->format(\DateTimeImmutable::ATOM)
        ];
    }
}
