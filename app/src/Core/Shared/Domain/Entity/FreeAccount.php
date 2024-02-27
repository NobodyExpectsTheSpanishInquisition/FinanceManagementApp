<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Entity;

use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\CreatedAt;

final readonly class FreeAccount extends Account
{
    public function __construct(AccountId $id, private User $user, CreatedAt $createdAt)
    {
        parent::__construct($id, AccountType::FREE, $createdAt);
    }
}
