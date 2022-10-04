<?php

declare(strict_types = 1);

namespace TicTacToe\Engine\Presentation\Console;

use TicTacToe\Engine\Presentation\Output;

final class ConsoleOutput implements Output
{
    private const ERROR = "\033[31mERROR: %s";
    private const SUCCESS = "\033[32m%s";
    private const INFO = "\033[0mINFO: %s";
    private const WARNING = "\033[33mWarning: %s";

    private const STRING_PADDING_LENGTH = 64;

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

    public function writeLine(string $message): void
    {
        $this->getBorderedStringWithPadding($message);
    }

    private function getBorderedStringWithPadding(string $string, string $padding = " "): string
    {
        return "|" . $this->getPaddedStringForOutput($string, $padding) . "|";
    }

    private function getPaddedStringForOutput(string $string, string $padding = " "): string
    {
        return str_pad($string, self::STRING_PADDING_LENGTH, $padding, STR_PAD_BOTH);
    }
}
