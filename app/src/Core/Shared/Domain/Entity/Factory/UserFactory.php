<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Entity\Factory;

use App\Core\Shared\Domain\Entity\Credentials;
use App\Core\Shared\Domain\Entity\User;
use App\Core\Shared\Domain\ValueObject\CreatedAt;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\HashedPassword;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UpdatedAt;
use App\Core\Shared\Domain\ValueObject\UserId;

final readonly class UserFactory
{
    public function create(
        UserId $userId,
        FirstName $firstName,
        LastName $lastName,
        Email $email,
        HashedPassword $password,
        CreatedAt $createdAt
    ): User {
        return new User(
            $userId,
            $firstName,
            $lastName,
            $email,
            new Credentials(
                $email,
                $password,
                new UpdatedAt($createdAt->timestamp)
            ),
            $createdAt
        );
    }
}
