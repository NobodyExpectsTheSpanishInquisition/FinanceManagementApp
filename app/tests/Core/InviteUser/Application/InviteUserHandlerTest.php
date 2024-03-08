<?php

namespace App\Tests\Core\InviteUser\Application;

use App\Core\InviteUser\Application\InviteUserHandler;
use App\Tests\ApplicationTestCase;
use App\Tests\Spy\EventDispatcherSpy;

final class InviteUserHandlerTest extends ApplicationTestCase
{
    private EventDispatcherSpy $eventDispatcherSpy;
    private InviteUserHandlerTestData $testData;
    private InviteUserHandlerTestAssertions $assertions;
    private InviteUserHandler $handler;

    public function test_Handle_ShouldThrowException_WhenAccountNotFound(): void
    {
        $this->assertions->assertAccountNotFoundExceptionWasThrown();
        $this->handler->handle($this->testData->getCommand());

        $this->assertions->assertAccountWasNotCreated();
    }

    public function test_Handle_ShouldThrowException_WhenTryToInviteUserToFreeAccount(): void
    {
//        $this->handler->handle($this->testData->getCommand());
    }

    public function test_Handle_ShouldInviteUser_WhenAllRequirementsAreMet(): void
    {
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->eventDispatcherSpy = $this->spyEventDispatcher();
        $this->testData = new InviteUserHandlerTestData();
        $this->assertions = new InviteUserHandlerTestAssertions($this, $this->testData, $this->eventDispatcherSpy);
        $this->handler = $this->container->get(InviteUserHandler::class);
    }
}
