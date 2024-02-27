<?php

declare(strict_types=1);

namespace App\Core\RegisterFreeAccount\Application;

use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UserId;
use App\Core\Shared\Infrastructure\ValueObject\PlainPassword;

final readonly class RegisterFreeAccountCommand
{
    public function __construct(
        public AccountId $accountId,
        public UserId $userId,
        public FirstName $firstName,
        public LastName $lastName,
        public Email $email,
        public PlainPassword $password,
    ) {
    }
}
