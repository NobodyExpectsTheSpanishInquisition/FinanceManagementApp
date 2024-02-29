<?php

declare(strict_types=1);

namespace App\Estimations\Shared\Domain\Entity\Factory;

use App\Estimations\Shared\Domain\Entity\Estimation;
use App\Estimations\Shared\Domain\ValueObject\AccountId;
use App\Estimations\Shared\Domain\ValueObject\EstimationId;
use App\Estimations\Shared\Domain\ValueObject\EstimationType;
use App\Estimations\Shared\Domain\ValueObject\OwnerId;
use App\Estimations\Shared\Domain\ValueObject\Title;
use App\Shared\Domain\ValueObject\CreatedAt;
use App\Shared\Domain\ValueObject\UpdatedAt;

final readonly class EstimationFactory
{
    public function create(
        EstimationId $id,
        AccountId $accountId,
        OwnerId $ownerId,
        Title $title,
        EstimationType $estimationType,
        CreatedAt $createdAt,
        UpdatedAt $updatedAt
    ): Estimation {
        return new Estimation($id, $accountId, $ownerId, $title, $estimationType, $createdAt, $updatedAt);
    }
}
