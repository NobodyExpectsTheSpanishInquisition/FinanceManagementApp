<?php

namespace App\Tests\Shared\Infrastructure\Exception;

use App\Shared\Infrastructure\Exception\ExceptionConverter;
use App\Tests\UnitTestCase;

class ExceptionConverterTest extends UnitTestCase
{
    private ExceptionConverter $converter;


    public function testConvert_ShouldReturnJsonResponseWithMessageAndStatusCodeProvidedInException(): void
    {
        $exception = new TestRequestException('test', 422);

        $response = $this->converter->convertToJsonResponse($exception);

        self::assertEquals(
            json_encode(
                [
                    'error' => [
                        'message' => $exception->getMessage(),
                        'statusCode' => $exception->getCode(),
                    ],
                ]
            ),
            $response->getContent()
        );
        self::assertEquals($exception->getCode(), $response->getStatusCode());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->converter = new ExceptionConverter();
    }
}
