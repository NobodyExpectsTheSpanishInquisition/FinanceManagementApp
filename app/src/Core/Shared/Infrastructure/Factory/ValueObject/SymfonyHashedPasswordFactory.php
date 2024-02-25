<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Factory\ValueObject;

use App\Core\Shared\Domain\ValueObject\Exception\CannotCreatePasswordException;
use App\Core\Shared\Domain\ValueObject\Exception\CannotHashPasswordException;
use App\Core\Shared\Domain\ValueObject\Factory\HashedPasswordFactoryInterface;
use App\Core\Shared\Domain\ValueObject\HashedPassword;
use App\Core\Shared\Infrastructure\ValueObject\PlainPassword;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final readonly class SymfonyHashedPasswordFactory implements HashedPasswordFactoryInterface
{
    public function __construct(
        private ValidatorInterface $validator,
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    /**
     * @inheritDoc
     */
    public function fromPlainPassword(PlainPassword $plainPassword): HashedPassword
    {
        $violationsList = $this->validator->validate($plainPassword);

        if (0 !== $violationsList->count()) {
            throw CannotHashPasswordException::becauseThereIsViolation($violationsList->get(0)->getMessage());
        }

        return new HashedPassword($this->passwordHasher->hashPassword($plainPassword, $plainPassword->password));
    }
}
