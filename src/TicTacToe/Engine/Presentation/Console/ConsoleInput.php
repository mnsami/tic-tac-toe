<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Presentation\Console;

use TicTacToe\Engine\Presentation\Input;

final class ConsoleInput implements Input
{
    /**
     * @inheritDoc
     */
    public function readString($allowEmpty = false): string
    {
        $input = $this->readStringFromStream();
        if (empty($input) && !$allowEmpty) {
            throw new \InvalidArgumentException("Input cannot be empty.");
        }
        if (!is_string($input)) {
            throw new \InvalidArgumentException("Input is not a valid 'string'.");
        }

        return trim($input);
    }

    /**
     * @inheritDoc
     */
    public function readInteger(): int
    {
        $input = $this->readIntegerFromStream();
        if (!empty($input)) {
            if (!is_integer($input)) {
                throw new \InvalidArgumentException("Input is not a valid 'integer'.");
            }
        }

        $input = intval($input);
        return $input;
    }

    /**
     * @codeCoverageIgnore
     *
     * Read string from stream
     *
     * @return string
     */
    protected function readStringFromStream()
    {
        $string = trim(fgets(STDIN));
        return $string;
    }

    /**
     * @codeCoverageIgnore
     *
     * Return integer from stream
     *
     * @return integer
     */
    protected function readIntegerFromStream()
    {
        fscanf(STDIN, "%d\n", $number);
        return $number;
    }
}
