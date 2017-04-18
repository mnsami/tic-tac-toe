<?php

namespace TicTacToe\Test;

use TicTacToe\Application;
use TicTacToe\IO\IOHandler;
use TicTacToe\Test\BaseTest;

class ApplicationTest extends BaseTest
{
    private $application = null;

    public function testCheckInPlayersSuccess()
    {
        $ioHandlerStub = $this->createMock(IOHandler::class);

        $ioHandlerStub->expects($this->exactly(4))
            ->method('readstring')
            ->will($this->onConsecutiveCalls('foo','x','baar','o'));


        $application = new Application($ioHandlerStub);
        $application->checkInPlayers();

        $players = $application->getPlayers();

        $this->assertEquals(2, count($players));

        $this->assertEquals('foo', $players[0]->getName());
        $this->assertEquals('x', $players[0]->getMarker());
        $this->assertEquals('baar', $players[1]->getName());
        $this->assertEquals('o', $players[1]->getMarker());
    }

    public function testNextStepSuccess()
    {
        $ioHandlerStub = $this->createMock(IOHandler::class);

        $ioHandlerStub->expects($this->exactly(5))
            ->method('readstring')
            ->will($this->onConsecutiveCalls('foo','x','baar','o', '1'));


        $application = new Application($ioHandlerStub);
        $application->checkInPlayers();

        $players = $application->getPlayers();

        $this->assertEquals(0, $application->getMovesCount());
        $this->assertEquals(2, count($players));

        $this->assertEquals('foo', $players[0]->getName());
        $this->assertEquals('x', $players[0]->getMarker());
        $this->assertEquals('baar', $players[1]->getName());
        $this->assertEquals('o', $players[1]->getMarker());

        $this->invokeMethod($application, 'nextStep');
        $this->assertEquals(1, $application->getMovesCount());
        $this->assertNotNull($application->getCellValue(1));
    }

    public function testCheckInPlayersFailureAndRetrial()
    {
        $ioHandlerStub = $this->createMock(IOHandler::class);

        $ioHandlerStub->expects($this->any())
            ->method('readString')
            ->will($this->onConsecutiveCalls('foo','x','baar','x', 'o'));

        $application = new Application($ioHandlerStub);

        $application->checkInPlayers();
        $players = $application->getPlayers();

        $this->assertEquals(2, count($players));

        $this->assertEquals('foo', $players[0]->getName());
        $this->assertEquals('x', $players[0]->getMarker());
        $this->assertEquals('baar', $players[1]->getName());
        $this->assertEquals('o', $players[1]->getMarker());
    }

    public function testGetPlayerByMarkerSuccess()
    {
        $ioHandlerStub = $this->createMock(IOHandler::class);

        $ioHandlerStub->expects($this->any())
            ->method('readString')
            ->will($this->onConsecutiveCalls('foo','x','baar','x', 'o'));

        $application = new Application($ioHandlerStub);

        $application->checkInPlayers();
        $player = $this->invokeMethod($application, 'getPlayerByMarker', array('x'));

        $this->assertEquals('foo', $player->getName());
        $this->assertEquals('x', $player->getMarker());
    }

    public function testGetPlayerByMarkerReturnNull()
    {
        $ioHandlerStub = $this->createMock(IOHandler::class);

        $ioHandlerStub->expects($this->any())
            ->method('readString')
            ->will($this->onConsecutiveCalls('foo','x','baar','o'));

        $application = new Application($ioHandlerStub);

        $application->checkInPlayers();
        $player = $this->invokeMethod($application, 'getPlayerByMarker', array('i'));

        $this->assertNull($player);
    }

    public function testGetBorderedStringWithPadding()
    {
        $expected = "|############################foobaar#############################|";

        $ioHandler = new IOHandler();
        $application = new Application($ioHandler);
        $result = $this->invokeMethod($application, 'getBorderedStringWithPadding', array('foobaar', '#'));

        $this->assertEquals($expected, $result);
        $this->assertEquals(66, strlen($result));
    }

    public function testGetPaddedStringForOutput()
    {
        $expected = "############################foobaar#############################";

        $ioHandler = new IOHandler();
        $application = new Application($ioHandler);
        $result = $this->invokeMethod($application, 'getPaddedStringForOutput', array('foobaar', '#'));

        $this->assertEquals($expected, $result);
        $this->assertEquals(64, strlen($result));
    }

    public function testShowWelcome()
    {
        $expected = sprintf(IOHandler::INFO, "|################################################################|" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|                                                                |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|                        Tic-Tac-Toe Game                        |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|                                                                |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|################################################################|" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|                     Welcome to Tic-Tac-Toe                     |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|                                                                |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|            This is a two players tic-tac-toe game.             |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|                                                                |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|                           1 | 2 | 3                            |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|                          ---|---|---                           |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|                           4 | 5 | 6                            |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|                          ---|---|---                           |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|                           7 | 8 | 9                            |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|                                                                |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "| To start playing you need to press 's/S', then enter players   |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "| details (name and marker). If at anytime you want to draw the  |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "| board press 'd/D'.                                             |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|                                                                |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "| Enjoy!                                                         |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "|________________________________________________________________|" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, PHP_EOL);
        $expected .= sprintf(IOHandler::LIGHT_CYAN, "Press 's/S' to start the game... ");

        $ioHandler = new IOHandler();
        $application = new Application($ioHandler);

        $this->expectOutputString($expected);
        $this->invokeMethod($application, 'showWelcome');
    }

    public function testIsGameDrawFalse()
    {
        $ioHandler = new IOHandler();
        $application = new Application($ioHandler);

        $result = $this->invokeMethod($application, 'isGameDraw');

        $this->assertFalse($result);
    }

    public function testProcessKeyPressShowBoard()
    {
        $ioHandlerStub = $this->getMockBuilder(IOHandler::class)
            ->setMethods(['readString'])
            ->getMock();

        $ioHandlerStub->expects($this->any())
            ->method('readString')
            ->willReturn('d');

        $application = new Application($ioHandlerStub);

        $expected = "";
        $expected .= sprintf(IOHandler::INFO, "   |   |   " . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "---|---|---" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "   |   |   " . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "---|---|---" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO, "   |   |   " . PHP_EOL);

        $this->expectOutputString($expected);
        $this->invokeMethod($application, 'processInput');
    }

    public function testProcessKeyPressUnidentified()
    {
        $ioHandlerStub = $this->getMockBuilder(IOHandler::class)
            ->setMethods(['readString'])
            ->getMock();

        $ioHandlerStub->expects($this->any())
            ->method('readString')
            ->willReturn('q');

        $application = new Application($ioHandlerStub);

        $expected = "";
        $expected .= sprintf(IOHandler::WARNING, "Unidentified input." . PHP_EOL);

        $this->expectOutputString($expected);
        $this->invokeMethod($application, 'processInput');
    }

    public function testProcessInputEnterLocation()
    {
        $ioHandlerStub = $this->getMockBuilder(IOHandler::class)
            ->setMethods(['readString'])
            ->getMock();

        $ioHandlerStub->expects($this->any())
            ->method('readString')
            ->willReturn('1');

        $application = new Application($ioHandlerStub);

        $result = $this->invokeMethod($application, 'processInput');
        $this->assertEquals('1', $result);
    }

    public function testProcessKeyPressGameStart()
    {
        $ioHandlerStub = $this->getMockBuilder(IOHandler::class)
            ->setMethods(['readString'])
            ->getMock();

        $ioHandlerStub->expects($this->exactly(5))
            ->method('readString')
            ->will($this->onConsecutiveCalls('s','foo','x','baar','o'));

        $application = new Application($ioHandlerStub);

        $this->invokeMethod($application, 'processInput');
        $this->assertTrue($application->isGameStarted());
    }

    public function testGameIsDraw()
    {
        $expected = "";
        $expected .= sprintf(IOHandler::INFO,"|################################################################|" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO,"|                                                                |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO,"|                         It is a DRAW!                          |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO,"|               Thank you for playing Tic-Tac-Toe.               |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO,"|                                                                |" . PHP_EOL);
        $expected .= sprintf(IOHandler::INFO,"|################################################################|" . PHP_EOL);

        $ioHandler = new IOHandler();
        $application = new Application($ioHandler);
        $this->expectOutputString($expected);
        $this->invokeMethod($application, 'gameIsDraw');
    }
}
