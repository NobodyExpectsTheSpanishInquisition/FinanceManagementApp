<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Exception;

use App\Core\Shared\Domain\ValueObject\AccountId;
use Exception;

final class AccountNotFoundException extends Exception
{
    public static function becauseNoAccountMatchProvidedId(AccountId $accountId): self
    {
        return new self(sprintf('Account: %s not found.', $accountId->uuid));
    }
}
