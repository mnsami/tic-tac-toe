<?php

namespace TicTacToe\IO;

class IOHandler
{
    const ERROR = "\033[31mERROR: %s";
    const SUCCESS = "\033[32m%s";
    const INFO = "\033[0m%s";
    const WARNING = "\033[33mWarning: %s";
    const LIGHT_PURPLE = "\033[35m%s";
    const LIGHT_CYAN = "\033[36m%s";
    const LIGHT_BLUE = "\033[34m%s";
    const LIGHT_GREEN = "\033[32m%s";

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

    /**
     * Write line with no line breaks at the end
     *
     * @param string $output text to print
     * @param string $type   type of text ERROR, INFO, SUCCESS
     *
     * @return void
     */
    public function write($output = "", $type = self::INFO)
    {
        if (is_array($output)) {
            foreach ($output as $line) {
                echo sprintf($type, $line);
            }
        } elseif (!is_array($output)) {
            echo sprintf($type, $output);
        }
    }

    /**
     * Write line and adds new line afterwards.
     *
     * @param string $output text to print
     * @param string $type   type of text ERROR, INFO, SUCCESS
     *
     * @return void
     */
    public function writeLine($output = "", $type = self::INFO)
    {
        if (is_array($output)) {
            foreach ($output as $line) {
                $this->write($line . PHP_EOL, $type);
            }
        } elseif (!is_array($output)) {
            $this->write($output . PHP_EOL, $type);
        }
    }

    public function readInteger()
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

    public function readString($allowEmpty = false)
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
}
