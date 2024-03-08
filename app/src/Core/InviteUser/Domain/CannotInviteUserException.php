<?php

declare(strict_types=1);

namespace App\Core\InviteUser\Domain;

use Exception;

final class CannotInviteUserException extends Exception
{
    public static function becauseFreeAccountCanHaveOnlyOneUser(): self
    {
        return new self('Cannot invite user. Free accounts can have only one user.', 422);
    }
}
