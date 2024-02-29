<?php

declare(strict_types=1);

namespace App\Tests\Spy;

use App\Core\Shared\Application\Event\EventDispatcherInterface;
use App\Shared\Domain\Event\EventInterface;

final class EventDispatcherSpy implements EventDispatcherInterface
{
    /**
     * @var array<int, EventInterface>
     */
    private array $events;

    /**
     * @var array<int, EventInterface>
     */
    private array $dispatchedEvents;

    public function __construct()
    {
        $this->events = [];
        $this->dispatchedEvents = [];
    }

    public function dispatch(): void
    {
        $this->dispatchedEvents = $this->events;
        $this->events = [];
    }

    /**
     * @return array<int, EventInterface>
     */
    public function getDispatchedEvents(): array
    {
        return $this->dispatchedEvents;
    }

    public function push(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}
