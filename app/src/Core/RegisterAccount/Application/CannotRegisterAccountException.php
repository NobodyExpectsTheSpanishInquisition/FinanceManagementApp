<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Application;

use Exception;

final class CannotRegisterAccountException extends Exception
{
    public static function becauseAccountWithProvidedIdAlreadyExists(): self
    {
        return new self('Cannot register Account. An account with provided id already exists.', 422);
    }
}
