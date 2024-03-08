<?php

declare(strict_types=1);

namespace App\Core\InviteUser\Application;

use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UserId;

final readonly class InviteUserCommand
{
    public function __construct(
        public AccountId $accountId,
        public UserId $userId,
        public Email $email,
        public FirstName $firstName,
        public LastName $lastName
    ) {
    }
}
