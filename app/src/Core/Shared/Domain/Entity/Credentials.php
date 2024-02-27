<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Entity;

use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\HashedPassword;
use App\Core\Shared\Domain\ValueObject\UpdatedAt;
use JsonSerializable;

final readonly class Credentials implements JsonSerializable
{
    public function __construct(private Email $email, private HashedPassword $password, private UpdatedAt $updatedAt)
    {
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'updatedAt' => $this->updatedAt->toString(),
        ];
    }
}
