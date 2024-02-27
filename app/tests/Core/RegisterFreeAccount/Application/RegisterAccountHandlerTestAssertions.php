<?php

declare(strict_types=1);

namespace App\Tests\Core\RegisterFreeAccount\Application;

use App\Core\RegisterFreeAccount\Application\CannotRegisterAccountException;
use App\Core\Shared\Domain\Event\AccountRegistered;
use App\Tests\Spy\EventDispatcherSpy;

final readonly class RegisterAccountHandlerTestAssertions
{
    public function __construct(private RegisterFreeAccountHandlerTest $testCase)
    {
    }

    public function assertAccountRegistered(EventDispatcherSpy $eventDispatcherSpy): void
    {
        $events = $eventDispatcherSpy->getDispatchedEvents();

        $this->testCase::assertCount(1, $events);
        $this->testCase::assertInstanceOf(AccountRegistered::class, $events[0]);
    }

    public function assertExceptionWasThrownBecauseOfTakenEmail(): void
    {
        $this->testCase->expectExceptionObject(CannotRegisterAccountException::becauseProvidedEmailIsAlreadyTaken());
    }
}
