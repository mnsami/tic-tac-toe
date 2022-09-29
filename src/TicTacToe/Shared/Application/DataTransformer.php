<?php

declare(strict_types = 1);

namespace TicTacToe\Shared\Application;

interface DataTransformer
{
    /**
     * @return array<string, string>
     */
    public function toArray(): array;
}
