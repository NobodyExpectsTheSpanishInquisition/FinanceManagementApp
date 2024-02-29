<?php

declare(strict_types=1);

namespace App\Tests\Estimations\CreateEstimation\Application;

use App\Estimations\CreateEstimation\Application\CreateEstimationCommand;
use App\Estimations\Shared\Domain\ValueObject\AccountId;
use App\Estimations\Shared\Domain\ValueObject\EstimationId;
use App\Estimations\Shared\Domain\ValueObject\EstimationType;
use App\Estimations\Shared\Domain\ValueObject\OwnerId;
use App\Estimations\Shared\Domain\ValueObject\Title;

final readonly class CreateEstimationHandlerTestData
{
    public function getCommand(): CreateEstimationCommand
    {
        return new CreateEstimationCommand(
            new EstimationId('617B0B95-9186-4B8E-BCEB-E9B1A371C9AD'),
            $this->getAccountId(),
            $this->getOwnerId(),
            EstimationType::HOME_BUDGET,
            new Title('Test Estimation')
        );
    }

    public function loadData(): void
    {
    }

    private function getAccountId(): AccountId
    {
        return new AccountId('431494B3-7826-4EE0-B8BF-5A52CEE878CC');
    }

    private function getOwnerId(): OwnerId
    {
        return new OwnerId('7C572A62-FE52-46D9-BF08-E3F5720B78CC');
    }
}
