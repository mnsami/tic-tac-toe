<?php

namespace TicTacToe;

use TicTacToe\Engine\Infrastructure\CommandBus\GameCommandHandlerFactory;
use TicTacToe\Engine\Infrastructure\Persistence\InMemory\InMemoryEventStore;
use TicTacToe\Engine\Presentation\Console\ConsoleInput;
use TicTacToe\Engine\Presentation\Console\ConsoleOutput;
use TicTacToe\Engine\Presentation\Input;
use TicTacToe\Engine\Presentation\Output;
use TicTacToe\Shared\Infrastructure\CommandBus\CommandBusFactory;
use TicTacToe\Shared\Infrastructure\EventStore;

class Application
{
    private CommandBusFactory $commandBusFactory;

    private EventStore $eventStore;

    private Output $output;

    private Input $input;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eventStore = new InMemoryEventStore();
        $this->commandBusFactory = new CommandBusFactory(new GameCommandHandlerFactory(), $this->eventStore);
        $this->input = new ConsoleInput();
        $this->output = new ConsoleOutput();
    }

    /**
     * Process user key press input
     *
     * @return void
     */
    protected function processInput(): void
    {
        $keyPressed = $this->input->readString();

        switch ($keyPressed) {
            case 'd':
            case 'D':
                $this->output->info("D pressed");
                break;
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
                $this->output->warning('number pressed pressed');
                break;
            case 's':
            case 'S':
                $this->output->success('S pressed');
                break;
            default:
                $this->output->error("Unidentified input.");
                break;
        }
    }

    /**
     * Run the game
     *
     * @codeCoverageIgnore
     *
     * @return void
     */
    public function run()
    {
        while (true) {
            $this->processInput();
        }
    }
}
