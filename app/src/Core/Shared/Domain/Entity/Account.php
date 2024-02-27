<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Entity;

use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\CreatedAt;
use JsonSerializable;

abstract readonly class Account implements JsonSerializable
{
    public function __construct(
        protected AccountId $id,
        protected AccountType $accountType,
        protected CreatedAt $createdAt
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id->uuid,
            'type' => $this->accountType->value,
            'createdAt' => $this->createdAt->toString(),
        ];
    }
}
