<?php

declare(strict_types=1);

namespace App\Shared\Domain\Event;

use JsonSerializable;

interface EventInterface extends JsonSerializable
{
    public function getKey(): EventKey;

    /**
     * @return array{data: array<string, mixed>}
     */
    public function jsonSerialize(): array;
}
