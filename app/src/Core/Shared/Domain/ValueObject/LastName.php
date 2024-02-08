<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject;

final readonly class LastName
{
    public function __construct(public string $lastName)
    {
    }
}
