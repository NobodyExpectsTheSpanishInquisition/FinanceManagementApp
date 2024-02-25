<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Entity;

use App\Core\Shared\Domain\ValueObject\CreatedAt;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UserId;

final readonly class User
{
    public function __construct(
        private UserId $userId,
        private FirstName $firstName,
        private LastName $lastName,
        private Email $email,
        private CreatedAt $createdAt
    )
    {
    }
}
