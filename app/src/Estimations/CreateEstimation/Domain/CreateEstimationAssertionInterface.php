<?php

declare(strict_types=1);

namespace App\Estimations\CreateEstimation\Domain;

use App\Estimations\Shared\Domain\ValueObject\AccountId;

interface CreateEstimationAssertionInterface
{
    /**
     * @throws CannotCreateEstimationException
     */
    public function assert(AccountId $accountId): void;
}
