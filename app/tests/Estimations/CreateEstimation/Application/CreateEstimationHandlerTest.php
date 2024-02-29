<?php

declare(strict_types=1);

namespace App\Tests\Estimations\CreateEstimation\Application;

use App\Estimations\CreateEstimation\Application\CreateEstimationHandler;
use App\Estimations\CreateEstimation\Application\CreateEstimationHandlerTestAssertions;
use App\Estimations\CreateEstimation\Domain\CannotCreateEstimationException;
use App\Estimations\CreateEstimation\Domain\CreateEstimationAssertionInterface;
use App\Tests\ApplicationTestCase;
use App\Tests\Spy\EventDispatcherSpy;

final class CreateEstimationHandlerTest extends ApplicationTestCase
{
    private CreateEstimationHandlerTestData $testData;
    private CreateEstimationHandlerTestAssertions $assertions;
    private EventDispatcherSpy $eventDispatcherSpy;

    public function test_Handle_ShouldCreateEstimation_WhenAllRequirementsWereMeet(): void
    {
        $this->testData->loadData();

        $handler = $this->getHandler();
        $handler->handle($this->testData->getCommand());

        $this->assertions->assertEstimationCreated($this->eventDispatcherSpy);
    }

    public function test_Handle_ShouldThrowException_WhenCannotCreateEstimation(): void
    {
        $this->testData->loadData();
        $assertionsMock = $this->createMock(CreateEstimationAssertionInterface::class);
        $assertionsMock
            ->method('assert')
            ->willThrowException(CannotCreateEstimationException::becauseUserExceededAllowedEstimationAmount());
        $this->container->set(CreateEstimationAssertionInterface::class, $assertionsMock);
        $handler = $this->getHandler();

        $this->expectException(CannotCreateEstimationException::class);
        $handler->handle($this->testData->getCommand());

        $this->assertions->assertEstimationWasNotCreated($this->eventDispatcherSpy);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new CreateEstimationHandlerTestData();
        $this->assertions = new CreateEstimationHandlerTestAssertions($this);
        $this->eventDispatcherSpy = $this->spyEventDispatcher();
    }

    private function getHandler(): CreateEstimationHandler
    {
        return $this->container->get(CreateEstimationHandler::class);
    }
}
