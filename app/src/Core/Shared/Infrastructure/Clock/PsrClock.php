<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Clock;

use App\Core\Shared\Domain\Clock\ClockInterface;
use DateTimeImmutable;
use DateTimeZone;
use Exception;

final readonly class PsrClock implements ClockInterface
{
    public function __construct(private DateTimeZone $dateTimeZone)
    {
    }

    /**
     * @throws Exception
     */
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('now', $this->dateTimeZone);
    }
}
