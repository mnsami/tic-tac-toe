<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Player;

final class Player
{
    /** @var PlayerId */
    private $id;

    /** @var PlayerName */
    private $name;

    /** @var PlayerToken */
    private $gameToken;

    public function __construct(PlayerId $id, PlayerName $name, PlayerToken $token)
    {
        $this->id = $id;
        $this->name = $name;
        $this->gameToken = $token;
    }

    public static function createPlayerWithTokenX(string $name): Player
    {
        return new self(
            new PlayerId(),
            new PlayerName($name),
            PlayerToken::createGameTokenX()
        );
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

    public function token(): string
    {
        return (string) $this->gameToken;
    }
}
