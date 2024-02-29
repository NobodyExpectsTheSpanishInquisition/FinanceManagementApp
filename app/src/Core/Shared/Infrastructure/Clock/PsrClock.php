<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Clock;

use App\Shared\Domain\Clock\ClockException;
use App\Shared\Domain\Clock\ClockInterface;
use DateTimeImmutable;
use DateTimeZone;
use Exception;

final readonly class PsrClock implements ClockInterface
{
    public function __construct(private DateTimeZone $dateTimeZone, private string $format)
    {
    }

    /**
     * @throws Exception
     */
    public function now(): DateTimeImmutable
    {
        $now = new DateTimeImmutable('now', $this->dateTimeZone);
        $formattedTimestamp = DateTimeImmutable::createFromFormat(
            $this->format,
            $now->format($this->format),
            $this->dateTimeZone
        );

        if (false === $formattedTimestamp) {
            throw ClockException::cannotCreateTimeStamp();
        }

        return $formattedTimestamp;
    }
}
