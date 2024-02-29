<?php

declare(strict_types=1);

namespace App\Estimations\CreateEstimation\Application;

use App\Estimations\Shared\Domain\Event\EstimationCreated;
use App\Tests\Estimations\CreateEstimation\Application\CreateEstimationHandlerTest;
use App\Tests\Spy\EventDispatcherSpy;

final readonly class CreateEstimationHandlerTestAssertions
{
    public function __construct(private CreateEstimationHandlerTest $testCase)
    {
    }

    public function assertEstimationCreated(EventDispatcherSpy $eventDispatcherSpy): void
    {
        $events = $eventDispatcherSpy->getDispatchedEvents();
        $this->testCase::assertCount(1, $events);

        $dispatchedEvent = $events[0];
        $this->testCase::assertInstanceOf(EstimationCreated::class, $dispatchedEvent);
    }

    public function assertEstimationWasNotCreated(EventDispatcherSpy $eventDispatcherSpy): void
    {
        $this->testCase::assertEmpty($eventDispatcherSpy->getDispatchedEvents());
    }
}
