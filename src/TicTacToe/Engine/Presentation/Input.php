<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Presentation;

interface Input
{
    /**
     * @param bool $allowEmpty
     * @return string
     */
    public function readString($allowEmpty = false): string;

    /**
     * @return int
     */
    public function readInteger(): int;
}
