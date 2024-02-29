<?php

declare(strict_types=1);

namespace App\Estimations\CreateEstimation\Infrastructure;

use App\Estimations\Shared\Domain\ValueObject\AccountId;

final readonly class EstimationAssertionRepository implements EstimationAssertionRepositoryInterface
{
    /**
     * @TODO IMPLEMENT AFTER CREATION OF DATA HUB
     */
    public function countByAccountId(AccountId $accountId): int
    {
        return 0;
    }
}
