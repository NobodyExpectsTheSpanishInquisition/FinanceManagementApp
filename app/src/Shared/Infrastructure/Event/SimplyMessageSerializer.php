<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Event;

use App\Shared\Domain\Clock\ClockException;
use App\Shared\Domain\Clock\ClockInterface;
use App\Shared\Domain\Event\EventInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

final readonly class SimplyMessageSerializer implements SerializerInterface
{
    public function __construct(private ClockInterface $clock)
    {
    }

    /**
     * @param array<string, mixed> $encodedEnvelope
     */
    public function decode(array $encodedEnvelope): Envelope
    {
        return new Envelope(
            new class {
            }
        );
    }

    /**
     * @throws CannotEncodeEnvelopeException
     * @throws ClockException
     * @return array{body: non-empty-string}
     */
    public function encode(Envelope $envelope): array
    {
        $body = $envelope->getMessage();

        if (false === $body instanceof EventInterface) {
            throw CannotEncodeEnvelopeException::becauseEnvelopeBodyIsNotInstanceOfEventInterface();
        }

        $serializedBody = json_encode((new EventEnvelope($body, new DispatchedAt($this->clock->now())))
            ->jsonSerialize());

        if (false === $serializedBody) {
            throw CannotEncodeEnvelopeException::becauseCannotSerializeEventBody($body::class);
        }
        return ['body' => $serializedBody];
    }
}
