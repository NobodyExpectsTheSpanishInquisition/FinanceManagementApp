<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Application;

use App\Core\Shared\Domain\Clock\ClockInterface;
use App\Core\Shared\Domain\Entity\Factory\FreeAccountFactory;
use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\CreatedAt;

final readonly class RegisterAccountHandler
{
    public function __construct(private FreeAccountFactory $freeAccountFactory, private ClockInterface $clock)
    {
    }

    /**
     * @throws CannotRegisterAccountException
     */
    public function handle(RegisterAccountCommand $command): void
    {
        $accountType = $command->accountType;
        $createdAt = new CreatedAt($this->clock->now());

        $account = match ($accountType) {
            AccountType::FREE => $this->freeAccountFactory->create($command->accountId, $accountType, $createdAt),
            default => throw CannotRegisterAccountException::becauseProvidedAccountTypeIsNotSupported(
                $accountType->value
            )
        };
    }
}
