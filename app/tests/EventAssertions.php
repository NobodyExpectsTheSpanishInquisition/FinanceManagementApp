<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\InMemory\InMemoryTransport;

final readonly class EventAssertions
{
    public function __construct(private TestCase $testCase, private InMemoryTransport $transport)
    {
    }

    public function assertNumberOfConcreteEventsDispatched(string $eventClassname, int $expectedAmount): void
    {
        $events = array_filter(
            $this->transport->getSent(),
            static fn(Envelope $event) => $event->getMessage() instanceof $eventClassname
        );

        $this->testCase::assertCount($expectedAmount, $events);
    }
}
