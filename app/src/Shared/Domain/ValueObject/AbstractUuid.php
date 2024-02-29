<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

abstract readonly class AbstractUuid
{
    public function __construct(#[Assert\Uuid(versions: 4, strict: true)] public string $uuid)
    {
    }
}
