<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Entity;

use App\Core\Shared\Domain\ValueObject\CreatedAt;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UserId;
use JsonSerializable;

final readonly class User implements JsonSerializable
{
    public function __construct(
        private UserId $userId,
        private FirstName $firstName,
        private LastName $lastName,
        private Email $email,
        private Credentials $credentials,
        private CreatedAt $createdAt,
    )
    {
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->userId->uuid,
            'firstName' => $this->firstName->firstName,
            'lastName' => $this->lastName->lastName,
            'email' => $this->email->email,
            'credentials' => $this->credentials->jsonSerialize(),
            'createdAt' => $this->createdAt->timestamp
        ];
    }
}
