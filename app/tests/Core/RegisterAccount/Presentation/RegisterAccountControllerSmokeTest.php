<?php

namespace App\Tests\Core\RegisterAccount\Presentation;

use App\Tests\SmokeTestCase;
use App\Tests\TestHttpStatusCode;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class RegisterAccountControllerSmokeTest extends SmokeTestCase
{
    private RegisterAccountControllerTestData $testData;

    public function testRegisterAccount_ShouldReturn201StatusCode_WhenRequestHandledWithoutErrors(): void
    {
        $response = $this->sendPostRequest($this->testData->getRouteName(), $this->testData->getParameters());

        $this->assertResourceCreated($response);
    }

    public function testRegisterAccount_ShouldReturn422StatusCode_WhenHandlerThrowsException(): void
    {
        $response = $this->sendPostRequest($this->testData->getRouteName(), $this->testData->getParameters());

        self::assertEquals(422, $response->getStatusCode());
    }

    public function testRegisterAccount_ShouldReturn400StatusCode_WhenRequestMapperThrowsException(): void
    {
        $response = $this->sendPostRequest($this->testData->getRouteName(), $this->testData->getParameters());

        self::assertEquals(400, $response->getStatusCode());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new RegisterAccountControllerTestData();
    }
}
