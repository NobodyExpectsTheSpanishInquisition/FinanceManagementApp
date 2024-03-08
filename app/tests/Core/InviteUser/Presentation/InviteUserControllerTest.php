<?php

namespace App\Tests\Core\InviteUser\Presentation;

use App\Tests\SmokeTestCase;

final class InviteUserControllerTest extends SmokeTestCase
{
    private InviteUserControllerTestData $testData;

    //    public function test_Invoke_ShouldReturnResponseWith204StatusCode_WhenNoErrorOccurred(): void
//    {
//        $this->testData->loadData();
//
//        $response = $this->sentPutRequest(
//            routeName : $this->testData->getRouteName(),
//            content   : $this->testData->getContent(),
//            parameters: $this->testData->getUrlParams()
//        );
//
//        $this->assertNoContent($response);
//    }

    public function test_Invoke_ShouldReturnExceptionResponse_WhenExceptionOccurred(): void
    {
        $this->testData->loadData();

        $response = $this->sentPutRequest(
            routeName : $this->testData->getRouteName(),
            content   : $this->testData->getInvalidContent(),
            parameters: $this->testData->getUrlParams()
        );

        $this->assertExceptionResponseReturned($response);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new InviteUserControllerTestData();
    }
}
