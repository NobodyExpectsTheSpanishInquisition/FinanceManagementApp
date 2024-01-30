<?php

namespace App\Tests\Shared\Infrastructure\Exception;

use App\Shared\Infrastructure\Exception\CannotConvertExceptionHttpRuntimeException;
use App\Shared\Infrastructure\Exception\ExceptionConverter;
use App\Tests\UnitTestCase;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ExceptionConverterTest extends UnitTestCase
{
    private ExceptionConverter $converter;

    public function testConvert_ShouldThrowException_WhenUnrecognizedExceptionPassedToConvert(): void
    {
        $unrecognizedException = new TestUnrecognizedException();

        $this->expectException(CannotConvertExceptionHttpRuntimeException::class);
        $this->converter->convertToJsonResponse($unrecognizedException);
    }

    public function testConvert_ShouldReturnBadRequestHttpException_WhenInstanceOfRequestExceptionPassed(): void
    {
        $exception = new TestRequestException();

        $result = $this->converter->convertToJsonResponse($exception);

        self::assertInstanceOf(BadRequestHttpException::class, $result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->converter = new ExceptionConverter();
    }
}
