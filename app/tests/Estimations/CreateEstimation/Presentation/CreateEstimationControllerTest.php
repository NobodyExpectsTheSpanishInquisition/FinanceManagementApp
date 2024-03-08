<?php

namespace App\Tests\Estimations\CreateEstimation\Presentation;

use App\Shared\Presentation\Http\ExceptionResponse;
use App\Tests\SmokeTestCase;

final class CreateEstimationControllerTest extends SmokeTestCase
{
    private CreateEstimationControllerTestData $testData;

    public function test_Invoke_ShouldReturn201StatusCode_WhenNoExceptionOccurred(): void
    {
        $this->testData->loadData();

        $response = $this->sendPostRequest(
            $this->testData->getRoute(),
            $this->testData->getValidRequestParams(),
            $this->testData->getQueryParams()
        );

        $this->assertResourceCreated($response);
    }

    public function test_Invoke_ShouldReturnExceptionResponse_WhenExceptionOccurred(): void
    {
        $this->testData->loadData();

        $response = $this->sendPostRequest(
            $this->testData->getRoute(),
            $this->testData->getInvalidRequestParams(),
            $this->testData->getQueryParams()
        );

        $this->assertExceptionResponseReturned($response);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new CreateEstimationControllerTestData();
    }
}
