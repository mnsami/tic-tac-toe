<?php

declare(strict_types = 1);

namespace TicTacToe\Infrastructure\UI\Console;

use TicTacToe\Infrastructure\UI\Output;

final class ConsoleOutput implements Output
{
    private const ERROR = "\033[31mERROR: %s";
    private const SUCCESS = "\033[32m%s";
    private const INFO = "\033[0m%s";
    private const WARNING = "\033[33mWarning: %s";

    public function error(string $error)
    {
        echo sprintf(self::ERROR, $error);
    }

    public function success(string $message)
    {
        echo sprintf(self::success, $message);
    }

    public function warning(string $message)
    {
        echo sprintf(self::warning, $message);
    }

    public function info(string $message)
    {
        echo sprintf(self::INFO, $message);
    }
}
