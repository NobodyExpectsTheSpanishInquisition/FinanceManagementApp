<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Event;

use App\Core\Shared\Application\Event\EventDispatcherInterface;
use App\Core\Shared\Domain\Event\EventInterface;

final class MessengerEventDispatcher implements EventDispatcherInterface
{
    /**
     * @var array<int, EventInterface>
     */
    private array $events;

    public function __construct()
    {
        $this->events = [];
    }

    public function dispatch(): void
    {
        // TODO: Implement dispatch() method.
    }

    public function push(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}
