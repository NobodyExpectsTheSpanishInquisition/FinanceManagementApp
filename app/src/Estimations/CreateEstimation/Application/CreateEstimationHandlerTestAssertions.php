<?php

declare(strict_types=1);

namespace App\Estimations\CreateEstimation\Application;

use App\Estimations\Shared\Domain\Event\EstimationCreated;
use App\Tests\Estimations\CreateEstimation\Application\CreateEstimationHandlerTest;

final readonly class CreateEstimationHandlerTestAssertions
{
    public function __construct(private CreateEstimationHandlerTest $testCase)
    {
    }

    public function assertEstimationCreated(): void
    {
        $this->testCase->getEventAssertions()
            ->assertNumberOfConcreteEventsDispatched(EstimationCreated::class, 1);
    }

    public function assertEstimationWasNotCreated(): void
    {
        $this->testCase->getEventAssertions()
            ->assertNumberOfConcreteEventsDispatched(EstimationCreated::class, 0);
    }
}
