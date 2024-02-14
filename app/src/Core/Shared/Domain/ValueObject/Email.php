<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class Email
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Email]
        public string $email
    ) {
    }
}
