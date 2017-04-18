<?php

namespace TicTacToe\Test;

use TicTacToe\IO\IOHandler;
use PHPUnit\Framework\TestCase;

class IOHandlerTest extends TestCase
{
    protected $ioHandler;

    public function setUp()
    {
        $this->ioHandler = $this->getMockBuilder(IOHandler::class)
            ->setMethods(['readStringFromStream', 'readIntegerFromStream'])
            ->getMock();
    }

    public function testReadStringEmptyInput()
    {
        $this->ioHandler->expects($this->once())
            ->method('readStringFromStream')
            ->willReturn('');

        try {
            $string = $this->ioHandler->readString();
        } catch (\Exception $e) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $e);
        }
    }

    public function testReadStringSuccess()
    {
        $this->ioHandler->expects($this->once())
            ->method('readStringFromStream')
            ->willReturn('foo');

        $string = $this->ioHandler->readString();
        $this->assertEquals('foo', $string);
    }

    public function testReadStringNotString()
    {
        $this->ioHandler->expects($this->once())
            ->method('readStringFromStream')
            ->willReturn(123);

        try {
            $string = $this->ioHandler->readString();
        } catch (\Exception $e) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $e);
        }
    }

    public function testReadIntegerSuccess()
    {
        $this->ioHandler->expects($this->once())
            ->method('readIntegerFromStream')
            ->willReturn(123);

        $integer = $this->ioHandler->readInteger();
        $this->assertEquals(123, $integer);
    }

    public function testReadIntegerFailure()
    {
        $this->ioHandler->expects($this->once())
            ->method('readIntegerFromStream')
            ->willReturn("ABC");

        try {
            $integer = $this->ioHandler->readInteger();
        } catch (\Exception $e) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $e);
        }
    }

    public function testWrite()
    {
        $this->expectOutputString(sprintf(IOHandler::INFO, "foo"));
        $this->ioHandler->write("foo");
    }

    public function testWriteWithArrayAsInput()
    {
        $expected = sprintf(IOHandler::INFO, "foo") . sprintf(IOHandler::INFO, "bar");
        $this->expectOutputString($expected);
        $lines[] = "foo";
        $lines[] = "bar";
        $this->ioHandler->write($lines);
        // var_dump($this->getActualOutput());
    }

    public function testWriteLine()
    {
        $this->expectOutputString(sprintf(IOHandler::INFO, "foo" . PHP_EOL));
        $this->ioHandler->writeLine("foo");
    }

    public function testWriteLineWithArrayAsInput()
    {
        $expected = sprintf(IOHandler::INFO, "foo" . PHP_EOL) . sprintf(IOHandler::INFO, "bar" . PHP_EOL);
        $this->expectOutputString($expected);
        $lines[] = "foo";
        $lines[] = "bar";
        $this->ioHandler->writeLine($lines);
    }
}
