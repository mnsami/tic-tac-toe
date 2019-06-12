<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use TicTacToe\Domain\Board\Board;
use TicTacToe\Domain\Game\Exception\SorryTooManyPlayers;
use TicTacToe\Domain\Game\Game;
use TicTacToe\Domain\Game\GameId;
use TicTacToe\Domain\Player\Player;

class GameTest extends TestCase
{
    public function testItCreatesGameSuccessfully()
    {
        $gameId = new GameId();
        $players = $this->createPlayers(2);
        $game = new Game($gameId, Board::create3By3Board(), ...$players);

        self::assertEquals(2, $game->players()->count());
        self::assertInstanceOf(GameId::class, $game->id());
    }

    public function testItThrowsTooManyPlayersWhenMorePlayersCreated()
    {
        $gameId = new GameId();
        $players = $this->createPlayers(3);
        self::expectException(SorryTooManyPlayers::class);
        $game = new Game($gameId, Board::create3By3Board(), ...$players);
    }

    public function randomizeString(int $length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function createPlayers(int $count)
    {
        $players = [];
        for($i = 0; $i < $count; $i++) {
            if ($i % 2 == 0) {
                $players[] = Player::createPlayerWithTokenX($this->randomizeString(5));
            } else {
                $players[] = Player::createPlayerWithTokenY($this->randomizeString(5));
            }
        }

        return $players;
    }
}
