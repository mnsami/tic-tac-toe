<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use TicTacToe\Engine\Domain\Model\Board\Board;
use TicTacToe\Engine\Domain\Model\Game\Exception\SorryTooManyPlayers;
use TicTacToe\Engine\Domain\Model\Game\Game;
use TicTacToe\Engine\Domain\Model\Game\GameId;
use TicTacToe\Engine\Domain\Model\Player\Player;

class GameTest extends TestCase
{
    public function testItCreatesGameSuccessfully()
    {
        $gameId = new GameId();
        $playerIds = $this->createPlayers(2);
        $game = Game::start($gameId, Board::create3By3Board(), ...$playerIds);

        self::assertEquals(2, $game->playerIds()->count());
        self::assertInstanceOf(GameId::class, $game->id());
        self::assertInstanceOf(Board::class, $game->board());
    }

    public function testItThrowsTooManyPlayersWhenMorePlayersCreated()
    {
        $gameId = new GameId();
        $playerIds = $this->createPlayers(3);
        self::expectException(SorryTooManyPlayers::class);
        Game::start($gameId, Board::create3By3Board(), ...$playerIds);
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
                $players[] = Player::createPlayerWithTokenX($this->randomizeString(5))->id();
            } else {
                $players[] = Player::createPlayerWithTokenY($this->randomizeString(5))->id();
            }
        }

        return $players;
    }
}
