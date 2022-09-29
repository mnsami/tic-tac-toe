<?php

declare(strict_types = 1);

namespace TicTacToe\Shared\Domain\Model;

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
     * @return array<string, string>
     */
    public function toArray(): array;

    /**
     * Get event name
     *
     * @return string
     */
    public function name(): string;
}
