<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject\Exception;

use Exception;

final class CannotHashPasswordException extends Exception
{
    public static function becauseThereIsViolation(string $violation): self
    {
        return new self($violation);
    }
}
