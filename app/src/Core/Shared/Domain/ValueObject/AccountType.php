<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject;

enum AccountType
{
    case FREE;
    case PREMIUM;
    case ENTERPRISE;
}
