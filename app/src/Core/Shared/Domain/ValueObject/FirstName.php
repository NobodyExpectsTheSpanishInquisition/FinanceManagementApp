<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class FirstName
{
    public function __construct(#[Assert\NotBlank] public string $firstName)
    {
    }
}
