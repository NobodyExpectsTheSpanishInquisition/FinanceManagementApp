<?php

declare(strict_types=1);

namespace App\Estimations\CreateEstimation\Application;

use App\Estimations\Shared\Domain\ValueObject\AccountId;
use App\Estimations\Shared\Domain\ValueObject\EstimationId;
use App\Estimations\Shared\Domain\ValueObject\EstimationType;
use App\Estimations\Shared\Domain\ValueObject\OwnerId;
use App\Estimations\Shared\Domain\ValueObject\Title;

final readonly class CreateEstimationCommand
{
    public function __construct(
        public EstimationId $id,
        public AccountId $accountId,
        public OwnerId $ownerId,
        public EstimationType $type,
        public Title $title,
    ) {
    }
}
