<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Presentation;

use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\HashedPassword;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\Uuid;

final readonly class RegisterAccountRequest
{
    public function __construct(
        public Uuid $accountId,
        public FirstName $firstName,
        public LastName $lastName,
        public Email $email,
        public HashedPassword $hashedPassword,
        public AccountType $accountType
    ) {
    }
}
