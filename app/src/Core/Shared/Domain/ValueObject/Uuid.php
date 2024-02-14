<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class Uuid
{
    public function __construct(#[Assert\Uuid(versions: 4, strict: true)] public string $uuid)
    {
    }
}
