<?php

namespace App\Tests\Core\RegisterFreeAccount\Presentation;

use App\Tests\SmokeTestCase;

class RegisterFreeAccountControllerTest extends SmokeTestCase
{
    private RegisterFreeAccountControllerTestData $testData;

    public function test_Invoke_ShouldReturn201StatusCode_WhenRequestHandledWithoutErrors(): void
    {
        $response = $this->sendPostRequest($this->testData->getRouteName(), $this->testData->getRequestContentArray());

        $this->assertResourceCreated($response);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new RegisterFreeAccountControllerTestData();
    }
}
