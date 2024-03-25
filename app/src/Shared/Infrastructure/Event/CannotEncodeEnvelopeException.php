<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Event;

use App\Shared\Domain\Event\EventInterface;
use Exception;

final class CannotEncodeEnvelopeException extends Exception
{
    public static function becauseEnvelopeBodyIsNotInstanceOfEventInterface(): self
    {
        return new self(sprintf('Envelope body has to be instance of %s', EventInterface::class));
    }

    /**
     * @param class-string $eventClassName
     */
    public static function becauseCannotSerializeEventBody(string $eventClassName): self
    {
        return new self(sprintf('Cannot serialize event body: %s', $eventClassName));
    }
}
