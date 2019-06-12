<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Shared;

interface DataTransformer
{
    /**
     * @return array
     */
    public function toArray(): array;
}
