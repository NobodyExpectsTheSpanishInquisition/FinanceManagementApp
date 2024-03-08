<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Repository;

use App\Core\Shared\Domain\Entity\Account;
use App\Core\Shared\Domain\Exception\AccountNotFoundException;
use App\Core\Shared\Domain\Provider\AccountProviderInterface;
use App\Core\Shared\Domain\ValueObject\AccountId;

final readonly class AccountRepository implements AccountProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getById(AccountId $accountId): Account
    {
        throw AccountNotFoundException::becauseNoAccountMatchProvidedId($accountId);
    }
}
