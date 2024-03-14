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

    public function assertAccountRegistered(): void
    {
        $this->testCase->getEventAssertions()
            ->assertNumberOfConcreteEventsDispatched(AccountRegistered::class, 1);
    }

    public function assertExceptionWasThrownBecauseOfTakenEmail(): void
    {
        $this->testCase->expectExceptionObject(CannotRegisterAccountException::becauseProvidedEmailIsAlreadyTaken());
    }
}
