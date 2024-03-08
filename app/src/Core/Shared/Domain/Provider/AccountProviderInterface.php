<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Provider;

use App\Core\Shared\Domain\Entity\Account;
use App\Core\Shared\Domain\Exception\AccountNotFoundException;
use App\Core\Shared\Domain\ValueObject\AccountId;

interface AccountProviderInterface
{
    /**
     * @throws AccountNotFoundException
     */
    public function getById(AccountId $accountId): Account;
}
