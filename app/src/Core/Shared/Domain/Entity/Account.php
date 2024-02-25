<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Entity;

use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\CreatedAt;

abstract readonly class Account
{
    public function __construct(protected AccountId $id, protected AccountType $accountType, protected CreatedAt $createdAt)
    {
    }
}
