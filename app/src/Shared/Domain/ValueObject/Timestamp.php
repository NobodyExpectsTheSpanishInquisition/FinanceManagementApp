<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use DateTimeInterface;

abstract readonly class Timestamp
{
    public function __construct(public DateTimeInterface $timestamp)
    {
    }

    public function toString(): string
    {
        return $this->timestamp->format(DateTimeInterface::ATOM);
    }
}
