<?php

declare(strict_types = 1);

namespace TicTacToe\Application\Player;

final class CreatePlayerCommand
{
    /** @var string */
    private $name;

    /** @var string */
    private $token;

    public function __construct(string $name, string $token)
    {
        $this->name = $name;
        $this->token = $token;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function token(): string
    {
        return $this->token;
    }
}
