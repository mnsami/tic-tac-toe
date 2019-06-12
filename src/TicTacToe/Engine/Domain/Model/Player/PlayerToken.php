<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Model\Player;

use TicTacToe\Domain\Model\Player\Exception\SorryInvalidPlayerToken;

final class PlayerToken
{
    /** @var string */
    private $token;

    private const X_TOKEN = 'x';
    private const Y_TOKEN = 'y';
    private const ALLOWED_TOKENS = [
        self::X_TOKEN,
        self::Y_TOKEN,
    ];

    public function __construct(string $token)
    {
        if (!in_array(strtolower($token), self::ALLOWED_TOKENS)) {
            throw new SorryInvalidPlayerToken("Only allowed tokens are: " . self::X_TOKEN . ", and " . self::Y_TOKEN);
        }

        $this->token = $token;
    }

    public static function createGameTokenX(): PlayerToken
    {
        return new self(self::X_TOKEN);
    }

    public static function createGameTokenY(): PlayerToken
    {
        return new self(self::Y_TOKEN);
    }

    public function __toString(): string
    {
        return $this->token;
    }
}
