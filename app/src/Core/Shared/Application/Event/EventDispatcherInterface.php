<?php

declare(strict_types=1);

namespace App\Core\Shared\Application\Event;

use App\Shared\Domain\Event\EventQueueInterface;

interface EventDispatcherInterface extends EventQueueInterface
{
    public function dispatch(): void;
}
