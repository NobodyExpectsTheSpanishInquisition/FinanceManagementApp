<?php

declare(strict_types=1);

namespace App\Estimations\Shared\Domain\Entity;

use App\Estimations\Shared\Domain\ValueObject\AccountId;
use App\Estimations\Shared\Domain\ValueObject\EstimationId;
use App\Estimations\Shared\Domain\ValueObject\EstimationType;
use App\Estimations\Shared\Domain\ValueObject\OwnerId;
use App\Estimations\Shared\Domain\ValueObject\Title;
use App\Shared\Domain\ValueObject\CreatedAt;
use App\Shared\Domain\ValueObject\UpdatedAt;
use JsonSerializable;

final readonly class Estimation implements JsonSerializable
{
    public function __construct(
        private EstimationId $id,
        private AccountId $accountId,
        private OwnerId $ownerId,
        private Title $title,
        private EstimationType $type,
        private CreatedAt $createdAt,
        private UpdatedAt $updatedAt
    ) {
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id->uuid,
            'accountId' => $this->accountId->uuid,
            'ownerId' => $this->ownerId->uuid,
            'title' => $this->title->title,
            'type' => $this->type->value,
            'createdAt' => $this->createdAt->toString(),
            'updatedAt' => $this->updatedAt->toString(),
        ];
    }
}
