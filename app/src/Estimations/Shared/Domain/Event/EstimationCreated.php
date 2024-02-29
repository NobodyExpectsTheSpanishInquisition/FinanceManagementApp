<?php

declare(strict_types=1);

namespace App\Estimations\Shared\Domain\Event;

use App\Estimations\Shared\Domain\Entity\Estimation;
use App\Shared\Domain\Event\EventInterface;
use App\Shared\Domain\Event\EventTimestamp;

final readonly class EstimationCreated implements EventInterface
{
    public function __construct(private Estimation $estimation, private EventTimestamp $timestamp)
    {
    }

    /**
     * @return array<string, mixed>
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
}
