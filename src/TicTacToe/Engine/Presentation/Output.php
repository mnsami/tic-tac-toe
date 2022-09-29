<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Presentation;

interface Output
{
    public function error(string $error): void;

    public function success(string $message): void;

    public function warning(string $message): void;

    public function info(string $message): void;
}
