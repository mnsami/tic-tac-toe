<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Application\CreateNewPlayer;

use TicTacToe\Shared\Application\Command;

final class CreateNewPlayerCommand implements Command
{
    private string $name;

    private string $token;

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
