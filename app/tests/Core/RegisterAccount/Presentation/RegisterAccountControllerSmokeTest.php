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
        $this->expectException(UnprocessableEntityHttpException::class);
        $this->expectExceptionCode(TestHttpStatusCode::UNPROCESSABLE_ENTITY->value);
        $this->sendPostRequest($this->testData->getRouteName(), $this->testData->getParameters());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new RegisterAccountControllerTestData();
    }
}
