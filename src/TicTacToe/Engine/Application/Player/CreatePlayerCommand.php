<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Application\Player;

use TicTacToe\Domain\Shared\Command;

final class CreatePlayerCommand implements Command
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
