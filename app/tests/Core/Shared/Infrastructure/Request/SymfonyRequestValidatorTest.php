<?php

namespace App\Tests\Core\Shared\Infrastructure\Request;

use App\Core\Shared\Infrastructure\Request\InvalidRequestException;
use App\Core\Shared\Infrastructure\Request\SymfonyRequestValidator;
use App\Tests\ApplicationTestCase;
use App\Tests\Stub\TestRequestStub;

final class SymfonyRequestValidatorTest extends ApplicationTestCase
{
    private SymfonyRequestValidator $validator;

    public function test_AssertRequestIsValid_ShouldNotThrowException_WhenRequestHasValidValue(): void
    {
        $validValue = 'valid value';
        $validRequest = new TestRequestStub($validValue);

        $this->validator->assertRequestIsValid($validRequest);

        self::assertEquals($validValue, $validRequest->value);
    }

    public function test_AssertRequestIsValid_ShouldThrowException_WhenValueIsBlank(): void
    {
        $blankValue = '';
        $invalidRequest = new TestRequestStub($blankValue);

        $this->expectException(InvalidRequestException::class);
        $this->validator->assertRequestIsValid($invalidRequest);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = $this->container->get(SymfonyRequestValidator::class);
    }
}
