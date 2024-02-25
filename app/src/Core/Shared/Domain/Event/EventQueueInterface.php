<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Event;

interface EventQueueInterface
{
    public function push(EventInterface $event): void;
}
