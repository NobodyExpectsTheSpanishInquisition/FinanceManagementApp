<?php

namespace App\Tests\Estimations\CreateEstimation\Infrastructure;

use App\Estimations\CreateEstimation\Domain\CannotCreateEstimationException;
use App\Estimations\CreateEstimation\Infrastructure\CreateEstimationAssertion;
use App\Estimations\CreateEstimation\Infrastructure\EstimationAssertionRepositoryInterface;
use App\Tests\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

final class CreateEstimationAssertionTest extends UnitTestCase
{
    private CreateEstimationAssertionTestData $testData;

    private EstimationAssertionRepositoryInterface&MockObject $estimationAssertionRepositoryMock;
    private CreateEstimationAssertion $assertion;

    public function test_Assert_ShouldThrowException_WhenUserExceededAllowedAmountOfEstimations(): void
    {
        $this->estimationAssertionRepositoryMock
            ->method('countByAccountId')
            ->willReturn(10);

        $this->expectExceptionObject(CannotCreateEstimationException::becauseUserExceededAllowedEstimationAmount());
        $this->assertion->assert($this->testData->getAccountId());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new CreateEstimationAssertionTestData();
        $this->estimationAssertionRepositoryMock = $this->createMock(EstimationAssertionRepositoryInterface::class);
        $this->assertion = new CreateEstimationAssertion($this->estimationAssertionRepositoryMock);
    }
}
