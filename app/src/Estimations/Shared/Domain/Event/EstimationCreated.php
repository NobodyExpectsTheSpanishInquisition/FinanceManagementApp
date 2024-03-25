<?php

declare(strict_types=1);

namespace App\Estimations\Shared\Domain\Event;

use App\Estimations\Shared\Domain\Entity\Estimation;
use App\Shared\Domain\Event\EventInterface;
use App\Shared\Domain\Event\EventKey;
use App\Shared\Domain\Event\EventTimestamp;

final readonly class EstimationCreated implements EventInterface
{
    public function __construct(private Estimation $estimation, private EventTimestamp $timestamp)
    {
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'data' => [
                'account' => $this->estimation->jsonSerialize(),
            ],
            'timestamp' => $this->timestamp->toString(),
        ];
    }

    public function getKey(): EventKey
    {
        return EventKey::ESTIMATION_CREATED;
    }
}
