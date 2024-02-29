<?php

declare(strict_types=1);

namespace App\Tests\Estimations\CreateEstimation\Infrastructure;

use App\Estimations\Shared\Domain\ValueObject\AccountId;

final readonly class CreateEstimationAssertionTestData
{
    public function getAccountId(): AccountId
    {
        return new AccountId('9E82E043-4BA0-4B0E-BC01-A8203228E8A1');
    }
}
