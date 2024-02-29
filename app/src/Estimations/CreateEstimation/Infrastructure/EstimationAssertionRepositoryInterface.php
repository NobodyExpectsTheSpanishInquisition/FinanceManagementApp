<?php

declare(strict_types=1);

namespace App\Estimations\CreateEstimation\Infrastructure;

use App\Estimations\Shared\Domain\ValueObject\AccountId;

interface EstimationAssertionRepositoryInterface
{
    public function countByAccountId(AccountId $accountId): int;
}
