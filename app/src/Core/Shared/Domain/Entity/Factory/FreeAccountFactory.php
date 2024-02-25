<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Entity\Factory;

use App\Core\Shared\Domain\Entity\FreeAccount;
use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\CreatedAt;

final readonly class FreeAccountFactory
{
    public function __construct(private UserFactory $userFactory)
    {
    }

    public function create(AccountId $accountId, AccountType $accountType, CreatedAt $createdAt): FreeAccount
    {
        return new FreeAccount($accountId, $accountType, $this->userFactory->create(), $createdAt);
    }
}
