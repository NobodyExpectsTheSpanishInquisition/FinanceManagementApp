<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject\Exception;

use Exception;

final class CannotCreateEmailException extends Exception
{
    public static function becauseEmailIsInvalid(string $invalidValue): self
    {
        return new self(sprintf('Invalid email value: %s. Email has to support RFC 5322.', $invalidValue));
    }
}
