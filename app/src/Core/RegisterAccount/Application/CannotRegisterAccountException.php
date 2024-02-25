<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Application;

use Exception;

final class CannotRegisterAccountException extends Exception
{
    public static function becauseAccountWithProvidedIdAlreadyExists(): self
    {
        return new self('Cannot register account. An account with provided id already exists.', 422);
    }

    public static function becauseProvidedAccountTypeIsNotSupported(string $value): self
    {
        return new self(sprintf('Cannot register account. Unsupported account type: %s.', $value), 422);
    }
}
