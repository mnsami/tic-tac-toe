<?php

declare(strict_types = 1);

namespace TicTacToe\Presentation;

interface Output
{
    public function error(string $error);

    public function success(string $message);

    public function warning(string $message);

    public function info(string $message);
}
