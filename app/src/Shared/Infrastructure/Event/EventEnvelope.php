<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Event;

use App\Shared\Domain\Event\EventInterface;
use JsonSerializable;

final readonly class EventEnvelope implements JsonSerializable
{
    public function __construct(private EventInterface $event, private DispatchedAt $dispatchedAt)
    {
    }

    /**
     * @return array{data: array<string, mixed>, key: string, dispatchedAt: string}
     */
    public function jsonSerialize(): array
    {
        $serializedEvent = $this->event->jsonSerialize();
        return [
            'data' => $serializedEvent['data'],
            'key' => $this->event->getKey()->name,
            'dispatchedAt' => $this->dispatchedAt->toString(),
        ];
    }
}
