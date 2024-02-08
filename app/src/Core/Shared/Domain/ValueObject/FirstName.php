<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject;

final readonly class FirstName
{
    public function __construct(public string $firstName)
    {
    }
}
