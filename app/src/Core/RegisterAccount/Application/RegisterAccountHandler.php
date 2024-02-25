<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Application;

use App\Core\Shared\Application\Event\EventDispatcherInterface;
use App\Core\Shared\Domain\Clock\ClockInterface;
use App\Core\Shared\Domain\Entity\Factory\FreeAccountFactory;
use App\Core\Shared\Domain\Event\AccountRegistered;
use App\Core\Shared\Domain\Event\EventTimestamp;
use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\CreatedAt;
use App\Core\Shared\Domain\ValueObject\Exception\CannotHashPasswordException;
use App\Core\Shared\Domain\ValueObject\Factory\HashedPasswordFactoryInterface;

final readonly class RegisterAccountHandler
{
    public function __construct(
        private FreeAccountFactory $freeAccountFactory,
        private ClockInterface $clock,
        private EventDispatcherInterface $eventDispatcher,
        private HashedPasswordFactoryInterface $hashedPasswordFactory
    )
    {
    }

    /**
     * @throws CannotRegisterAccountException
     * @throws CannotHashPasswordException
     */
    public function handle(RegisterAccountCommand $command): void
    {
        $accountType = $command->accountType;
        $createdAt = new CreatedAt($this->clock->now());

        $account = match ($accountType) {
            AccountType::FREE => $this->freeAccountFactory->create(
                $command->accountId,
                $accountType,
                $createdAt,
                $command->userId,
                $command->firstName,
                $command->lastName,
                $command->email,
                $this->hashedPasswordFactory->fromPlainPassword($command->password)
            ),
            default => throw CannotRegisterAccountException::becauseProvidedAccountTypeIsNotSupported(
                $accountType->value
            )
        };

        $this->eventDispatcher->push(new AccountRegistered($account, new EventTimestamp($createdAt->timestamp)));
        $this->eventDispatcher->dispatch();
    }
}
