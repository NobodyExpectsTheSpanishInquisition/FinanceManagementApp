<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Entity\Factory;

use App\Core\Shared\Domain\Entity\FreeAccount;
use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\CreatedAt;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\HashedPassword;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UserId;

final readonly class FreeAccountFactory
{
    public function __construct(private UserFactory $userFactory)
    {
    }

    public function create(
        AccountId $accountId,
        CreatedAt $createdAt,
        UserId $userId,
        FirstName $firstName,
        LastName $lastName,
        Email $email,
        HashedPassword $password
    ): FreeAccount {
        return new FreeAccount(
            $accountId,
            $this->userFactory->create(
                $userId,
                $firstName,
                $lastName,
                $email,
                $password,
                $createdAt
            ), $createdAt
        );
    }
}
