<?php

declare(strict_types = 1);

namespace TicTacToe\Shared\Infrastructure\CommandBus\Exception;

use Throwable;

class SorryCommandHandlerNotFound extends \Exception
{
    public function __construct(string $command)
    {
        $message = 'Unable to find a registered handler for ' . $command;

        parent::__construct($message);
    }
}
