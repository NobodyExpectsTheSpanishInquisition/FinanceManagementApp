<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject\Exception;

use Exception;

final class CannotCreateUuidException extends Exception
{
    public static function becauseInvalidValuePassedByRequest(string $invalidValue): self
    {
        return new self(sprintf('Invalid uuid value: %s. Uuid has to support v4.', $invalidValue), 422);
    }
}
