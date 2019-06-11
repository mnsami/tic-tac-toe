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

    private function __construct(PlayerId $id, PlayerName $name, PlayerToken $token)
    {
        $this->id = $id;
        $this->name = $name;
        $this->playingToken = $token;
    }

    public static function createPlayerWithTokenX(string $name): Player
    {
        $player =  new self(
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
        return new self(
            new PlayerId(),
            new PlayerName($name),
            PlayerToken::createGameTokenY()
        );
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
}
