<?php

declare(strict_types = 1);

namespace TicTacToe\Domain\Shared;

interface Event
{
    /**
     * Return event timestamp
     *
     * @return \DateTimeImmutable
     */
    public function occurredAt(): \DateTimeImmutable;

    /**
     * Return event data as array
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * Get event name
     *
     * @return string
     */
    public function name(): string;
}
