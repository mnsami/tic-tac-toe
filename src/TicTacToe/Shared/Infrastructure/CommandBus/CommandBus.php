<?php

declare(strict_types = 1);

namespace TicTacToe\Shared\Infrastructure\CommandBus;

use TicTacToe\Shared\Application\Command;
use TicTacToe\Shared\Application\DataTransformer;
use TicTacToe\Shared\Domain\Model\Event;

interface CommandBus
{
    /**
     * @param Command $command
     * @return DataTransformer
     */
    public function handle(Command $command): DataTransformer;

    /**
     * @return Event[]
     */
    public function events(): array;
}
