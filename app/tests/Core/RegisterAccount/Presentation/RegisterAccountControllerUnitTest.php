<?php

declare(strict_types=1);

namespace App\Tests\Core\RegisterAccount\Presentation;

use App\Core\RegisterAccount\Application\CannotRegisterAccountException;
use App\Core\RegisterAccount\Application\RegisterAccountHandler;
use App\Core\RegisterAccount\Presentation\RegisterAccountController;
use App\Core\RegisterAccount\Presentation\RegisterAccountRequestMapper;
use App\Shared\Infrastructure\Exception\ExceptionConverter;
use App\Tests\TestStatusCode;
use App\Tests\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\HttpFoundation\Request;

final class RegisterAccountControllerUnitTest extends UnitTestCase
{
    private RegisterAccountController $controller;
    private RegisterAccountHandler&MockObject $handlerMock;
    private RegisterAccountRequestMapper&MockObject $requestMapperMock;

    private Request&MockObject $requestMock;

    public function testRegister_ShouldReturnJsonResponseWith422StatusCode_WhenHandlerThrowsAnException(): void
    {
        $this->handlerMock->method('handle')
            ->willThrowException(CannotRegisterAccountException::becauseAccountWithProvidedIdAlreadyExists());

        $response = $this->controller->register($this->requestMock, $this->requestMapperMock, $this->handlerMock);

        self::assertEquals(TestStatusCode::UNPROCESSABLE_ENTITY->value, $response->getStatusCode());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = new RegisterAccountController(new ExceptionConverter());
        $this->handlerMock = $this->createMock(RegisterAccountHandler::class);
        $this->requestMapperMock = $this->createMock(RegisterAccountRequestMapper::class);
        $this->requestMock = $this->createMock(Request::class);
    }
}
