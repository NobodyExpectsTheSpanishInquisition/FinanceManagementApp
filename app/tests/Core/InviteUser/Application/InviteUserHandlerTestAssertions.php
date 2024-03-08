<?php

declare(strict_types=1);

namespace App\Tests\Core\InviteUser\Application;

use App\Core\Shared\Domain\Exception\AccountNotFoundException;
use App\Tests\Spy\EventDispatcherSpy;

final readonly class InviteUserHandlerTestAssertions
{
    public function __construct(
        private InviteUserHandlerTest $testCase,
        private InviteUserHandlerTestData $testData,
        private EventDispatcherSpy $eventDispatcherSpy
    ) {
    }

    public function assertAccountNotFoundExceptionWasThrown(): void
    {
        $this->testCase->expectExceptionObject(
            AccountNotFoundException::becauseNoAccountMatchProvidedId($this->testData->getAccountId())
        );
    }

    public function assertAccountWasNotCreated(): void
    {
        $this->testCase::assertEmpty($this->eventDispatcherSpy->getDispatchedEvents());
    }
}
