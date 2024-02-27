<?php

declare(strict_types=1);

namespace App\Core\RegisterFreeAccount\Application;

use Exception;

final class CannotRegisterAccountException extends Exception
{
    public static function becauseProvidedAccountTypeIsNotSupported(string $value): self
    {
        return new self(sprintf('Cannot register account. Unsupported account type: %s.', $value), 422);
    }

    public static function becauseProvidedEmailIsAlreadyTaken(): self
    {
        return new self('Cannot register account. User email is already taken.', 422);
    }
}
