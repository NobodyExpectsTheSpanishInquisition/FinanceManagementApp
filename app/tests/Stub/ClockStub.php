<?php

declare(strict_types=1);

namespace App\Tests\Stub;

use App\Shared\Domain\Clock\ClockInterface;
use DateTimeImmutable;
use DateTimeInterface;

final readonly class ClockStub implements ClockInterface
{
    /**
     * @inheritDoc
     */
    public function now(): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat(DateTimeInterface::ATOM, '2024-01-01T12:00:00+00:00');
    }
}
