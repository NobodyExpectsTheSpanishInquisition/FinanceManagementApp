<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Event;

use App\Shared\Domain\ValueObject\Timestamp;

final readonly class DispatchedAt extends Timestamp
{
}
