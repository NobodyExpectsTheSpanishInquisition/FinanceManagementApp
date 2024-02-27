<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

final readonly class HashedPassword implements PasswordAuthenticatedUserInterface
{
    public function __construct(public string $hashedPassword)
    {
    }

    public function getPassword(): ?string
    {
        return $this->hashedPassword;
    }
}
