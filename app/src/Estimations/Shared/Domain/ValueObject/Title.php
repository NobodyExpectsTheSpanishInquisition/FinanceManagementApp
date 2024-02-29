<?php

declare(strict_types=1);

namespace App\Estimations\Shared\Domain\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class Title
{
    public function __construct(#[Assert\NotBlank] public string $title)
    {
    }
}
