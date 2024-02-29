<?php

declare(strict_types=1);

namespace App\Core\RegisterFreeAccount\Application;

use App\Core\Shared\Application\Event\EventDispatcherInterface;
use App\Core\Shared\Application\Repository\EmailRepositoryInterface;
use App\Core\Shared\Domain\Entity\Factory\FreeAccountFactory;
use App\Core\Shared\Domain\Event\AccountRegistered;
use App\Core\Shared\Domain\ValueObject\Exception\CannotHashPasswordException;
use App\Core\Shared\Domain\ValueObject\Factory\HashedPasswordFactoryInterface;
use App\Shared\Domain\Clock\ClockException;
use App\Shared\Domain\Clock\ClockInterface;
use App\Shared\Domain\Event\EventTimestamp;
use App\Shared\Domain\ValueObject\CreatedAt;

final readonly class RegisterFreeAccountHandler
{
    public function __construct(
        private FreeAccountFactory $freeAccountFactory,
        private ClockInterface $clock,
        private EventDispatcherInterface $eventDispatcher,
        private HashedPasswordFactoryInterface $hashedPasswordFactory,
        private EmailRepositoryInterface $emailRepository
    ) {
    }

    /**
     * @throws CannotRegisterAccountException
     * @throws CannotHashPasswordException
     * @throws ClockException
     */
    public function handle(RegisterFreeAccountCommand $command): void
    {
        $createdAt = new CreatedAt($this->clock->now());

        if ($this->emailRepository->exists($command->email)) {
            throw CannotRegisterAccountException::becauseProvidedEmailIsAlreadyTaken();
        }

        $account = $this->freeAccountFactory->create(
            $command->accountId,
            $createdAt,
            $command->userId,
            $command->firstName,
            $command->lastName,
            $command->email,
            $this->hashedPasswordFactory->fromPlainPassword($command->password)
        );

        $this->eventDispatcher->push(new AccountRegistered($account, new EventTimestamp($createdAt->timestamp)));
        $this->eventDispatcher->dispatch();
    }
}
