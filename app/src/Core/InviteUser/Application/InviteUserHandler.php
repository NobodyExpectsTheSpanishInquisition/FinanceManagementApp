<?php

declare(strict_types=1);

namespace App\Core\InviteUser\Application;

use App\Core\Shared\Application\Event\EventDispatcherInterface;
use App\Core\Shared\Domain\Entity\Factory\UserFactory;
use App\Core\Shared\Domain\Exception\AccountNotFoundException;
use App\Core\Shared\Domain\Provider\AccountProviderInterface;

final readonly class InviteUserHandler
{
    public function __construct(
        private UserFactory $userFactory,
        private AccountProviderInterface $accountProvider,
        private EventDispatcherInterface $eventDispatcher
    ) {
    }

    /**
     * @throws AccountNotFoundException
     */
    public function handle(InviteUserCommand $command): void
    {
        $account = $this->accountProvider->getById($command->accountId);

        $account->inviteUser(
            $command->userId,
            $command->firstName,
            $command->lastName,
            $command->email,
            $this->userFactory,
            $this->eventDispatcher
        );

        $this->eventDispatcher->dispatch();
    }
}
