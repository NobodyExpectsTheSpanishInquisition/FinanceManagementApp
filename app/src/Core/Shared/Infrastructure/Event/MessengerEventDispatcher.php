<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Event;

use App\Core\Shared\Application\Event\EventDispatcherInterface;
use App\Shared\Domain\Event\EventInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerEventDispatcher implements EventDispatcherInterface
{
    /**
     * @var array<int, EventInterface>
     */
    private array $events;

    public function __construct(private readonly MessageBusInterface $bus)
    {
        $this->events = [];
    }

    public function dispatch(): void
    {
        foreach ($this->events as $event) {
            $this->bus->dispatch($event);
        }

        $this->events = [];
    }

    public function push(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}
