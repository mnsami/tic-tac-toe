<?php

declare(strict_types=1);

namespace TicTacToe\Shared\Application;

interface CommandHandler
{
    public function handles(): string;

    public function handle(Command $command): DataTransformer;
}
