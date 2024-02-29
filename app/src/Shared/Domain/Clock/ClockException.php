<?php

declare(strict_types=1);

namespace App\Shared\Domain\Clock;

use Exception;

final class ClockException extends Exception
{
    public static function cannotCreateTimeStamp(): self
    {
        return new self('Cannot create timestamp. Check timezone and format.');
    }
}
