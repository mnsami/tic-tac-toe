<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Player;

use TicTacToe\Domain\Player\Event\PlayerCreated;
use TicTacToe\Domain\Shared\AggregateRoot;

final class Player extends AggregateRoot
{
    /** @var PlayerId */
    private $id;

    /** @var PlayerName */
    private $name;

    /** @var PlayerToken */
    private $playingToken;

    /** @var \DateTimeImmutable */
    private $createdAt;

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

    public function name(): string
    {
        return (string) $this->name;
    }

    public function playingToken(): string
    {
        return (string) $this->playingToken;
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
