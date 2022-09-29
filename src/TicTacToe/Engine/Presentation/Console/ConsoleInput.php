<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Presentation\Console;

use TicTacToe\Engine\Presentation\Input;

final class ConsoleInput implements Input
{
    public function readString(bool $allowEmpty = false): string
    {
        $input = $this->readStringFromStream();
        if (empty($input) && !$allowEmpty) {
            throw new \InvalidArgumentException("Input cannot be empty.");
        }

        return trim($input);
    }

    public function readInteger(): int
    {
        $input = $this->readIntegerFromStream();
        if (!empty($input)) {
            throw new \InvalidArgumentException("Input cannot be empty.");
        }

        return $input;
    }

    protected function readStringFromStream(): string
    {
        $stream = fgets(STDIN);
        return trim($stream !== false ? $stream : '');
    }

    protected function readIntegerFromStream(): int
    {
        fscanf(STDIN, "%d\n", $number);
        return $number;
    }
}
