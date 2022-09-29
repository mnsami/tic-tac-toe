<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Presentation;

interface Input
{
    public function readString(bool $allowEmpty = false): string;

    public function readInteger(): int;
}
