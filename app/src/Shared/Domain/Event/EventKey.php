<?php

declare(strict_types=1);

namespace App\Shared\Domain\Event;

enum EventKey
{
    case ACCOUNT_REGISTERED;
    case ESTIMATION_CREATED;
}
