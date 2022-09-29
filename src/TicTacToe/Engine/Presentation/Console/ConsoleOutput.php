<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Presentation\Console;

use TicTacToe\Engine\Presentation\Output;

final class ConsoleOutput implements Output
{
    private const ERROR = "\033[31mERROR: %s\n";
    private const SUCCESS = "\033[32m%s\n";
    private const INFO = "\033[0mINFO: %s\n";
    private const WARNING = "\033[33mWarning: %s\n";

    public function error(string $error): void
    {
        echo sprintf(self::ERROR, $error);
    }

    public function success(string $message): void
    {
        echo sprintf(self::SUCCESS, $message);
    }

    public function warning(string $message): void
    {
        echo sprintf(self::WARNING, $message);
    }

    public function info(string $message): void
    {
        echo sprintf(self::INFO, $message);
    }
}
