<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Domain\Model\Player;

use TicTacToe\Engine\Domain\Model\Player\Event\PlayerCreated;
use TicTacToe\Engine\Domain\Model\Player\Exception\SorryInvalidPlayerToken;
use TicTacToe\Engine\Domain\Model\Player\Exception\SorryPlayerNameIsTooLong;
use TicTacToe\Engine\Domain\Model\Player\Exception\SorryPlayerNameIsTooShort;
use TicTacToe\Shared\Domain\Model\AggregateRoot;

final class Player extends AggregateRoot
{
    private PlayerId $id;

    private PlayerName $name;

    private PlayerToken $playingToken;

    private \DateTimeImmutable $createdAt;

    private function __construct(PlayerId $id, PlayerName $name, PlayerToken $token)
    {
        $this->id = $id;
        $this->name = $name;
        $this->playingToken = $token;
        $this->createdAt = new \DateTimeImmutable();
    }

    public static function createPlayerWithTokenX(string $name): Player
    {
        $player = new self(
            new PlayerId(),
            new PlayerName($name),
            PlayerToken::createGameTokenX()
        );

        $player->record(
            new PlayerCreated($player)
        );

        return $player;
    }

    public static function createPlayerWithTokenY(string $name): Player
    {
        $player = new self(
            new PlayerId(),
            new PlayerName($name),
            PlayerToken::createGameTokenY()
        );

        $player->record(
            new PlayerCreated($player)
        );

        return $player;
    }

    /**
     * @throws SorryPlayerNameIsTooLong
     * @throws SorryPlayerNameIsTooShort
     * @throws SorryInvalidPlayerToken
     */
    public static function createPlayerWithToken(string $name, string $token): Player
    {
        $player = new self(
            new PlayerId(),
            new PlayerName($name),
            new PlayerToken($token)
        );

        $player->record(
            new PlayerCreated($player)
        );

        return $player;
    }

    public function name(): string
    {
        return (string) $this->name;
    }

    public function playingToken(): PlayerToken
    {
        return $this->playingToken;
    }

    public function id(): PlayerId
    {
        return $this->id;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
