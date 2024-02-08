<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\ValueObject;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class PlainPassword implements PasswordAuthenticatedUserInterface
{
    #[Assert\PasswordStrength(minScore: Assert\PasswordStrength::STRENGTH_VERY_STRONG)]
    public string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}
