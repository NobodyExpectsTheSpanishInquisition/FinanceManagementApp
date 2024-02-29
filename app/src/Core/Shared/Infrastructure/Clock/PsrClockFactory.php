<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Clock;

use DateTimeZone;
use Exception;

final readonly class PsrClockFactory
{
    /**
     * @throws Exception
     */
    public static function create(string $timezone, string $format): PsrClock
    {
        return new PsrClock(new DateTimeZone($timezone), $format);
    }
}
