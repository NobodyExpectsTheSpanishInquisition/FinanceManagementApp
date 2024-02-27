<?php

declare(strict_types=1);

namespace App\Tests\Core\RegisterFreeAccount\Application;

use App\Core\RegisterFreeAccount\Application\RegisterFreeAccountHandler;
use App\Core\Shared\Application\Repository\EmailRepositoryInterface;
use App\Tests\ApplicationTestCase;
use App\Tests\Spy\EventDispatcherSpy;

final class RegisterFreeAccountHandlerTest extends ApplicationTestCase
{
    private RegisterAccountHandlerTestData $testData;
    private RegisterAccountHandlerTestAssertions $assertions;
    private EventDispatcherSpy $eventDispatcherSpy;

    public function test_Handle_ShouldCreateAccount_WhenAllDataAreCorrect(): void
    {
        $this->mockEmailRepository(doesEmailExists: false);
        $handler = $this->getHandler();

        $handler->handle($this->testData->getCommand());

        $this->assertions->assertAccountRegistered($this->eventDispatcherSpy);
    }

    public function test_Handle_ShouldThrowException_WhenProvidedEmailAlreadyExists(): void
    {
        $this->mockEmailRepository(doesEmailExists: true);
        $handler = $this->getHandler();

        $this->assertions->assertExceptionWasThrownBecauseOfTakenEmail();
        $handler->handle($this->testData->getCommand());
    }

    private function mockEmailRepository(bool $doesEmailExists): void
    {
        $emailRepositoryMock = $this->createMock(EmailRepositoryInterface::class);
        $emailRepositoryMock
            ->method('exists')
            ->willReturn($doesEmailExists);

        $this->container->set(EmailRepositoryInterface::class, $emailRepositoryMock);
    }

    private function getHandler(): RegisterFreeAccountHandler
    {
        return $this->container->get(RegisterFreeAccountHandler::class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new RegisterAccountHandlerTestData();
        $this->assertions = new RegisterAccountHandlerTestAssertions($this);
        $this->eventDispatcherSpy = $this->getEventDispatcherSpy();
    }
}
