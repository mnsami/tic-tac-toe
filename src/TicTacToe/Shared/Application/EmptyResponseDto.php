<?php

declare(strict_types=1);

namespace TicTacToe\Shared\Application;

class EmptyResponseDto implements DataTransformer
{
    public function toArray(): array
    {
        return [];
    }
}
