<?php

namespace App\Tests\Core\Shared\Infrastructure\Factory\ValueObject;

use App\Core\Shared\Domain\ValueObject\Exception\CannotCreatePasswordException;
use App\Core\Shared\Domain\ValueObject\HashedPassword;
use App\Core\Shared\Infrastructure\Factory\ValueObject\SymfonyHashedPasswordFactory;
use App\Core\Shared\Infrastructure\ValueObject\PlainPassword;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\Hasher\PlaintextPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SymfonyHashedPasswordFactoryTest extends TestCase
{
    private ValidatorInterface|MockObject $validatorMock;
    private string $plainPasswordString;
    private UserPasswordHasher $hasher;

    public function test_FromString_ShouldReturnHashedPassword_WhenPlainPasswordDoesNotHaveViolations(): void
    {
        $emptyViolationsList = new ConstraintViolationList([]);
        $this->validatorMock->method('validate')->willReturn($emptyViolationsList);
        $factory = $this->getFactory();

        $hashedPassword = $factory->fromPlainPassword($this->plainPasswordString);

        self::assertTrue($this->hasher->isPasswordValid($hashedPassword, $this->plainPasswordString));
    }

    public function test_FromString_ShouldThrowException_WhenPlainPasswordHasViolation(): void
    {
        $violation = new ConstraintViolation(
            message        : 'Password has violation',
            messageTemplate: null,
            parameters     : [],
            root           : new PlainPassword($this->plainPasswordString),
            propertyPath   : null,
            invalidValue   : $this->plainPasswordString
        );
        $violationList = new ConstraintViolationList([$violation]);
        $this->validatorMock->method('validate')->willReturn($violationList);
        $factory = $this->getFactory();

        $this->expectExceptionObject(CannotCreatePasswordException::becauseThereIsViolation($violation->getMessage()));
        $factory->fromPlainPassword($this->plainPasswordString);
    }

    private function getFactory(): SymfonyHashedPasswordFactory
    {
        return new SymfonyHashedPasswordFactory($this->validatorMock, $this->hasher);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->validatorMock = $this->createMock(ValidatorInterface::class);
        $this->hasher = new UserPasswordHasher(
            new PasswordHasherFactory(
                [
                    PlainPassword::class => new PlaintextPasswordHasher(),
                    HashedPassword::class => new PlaintextPasswordHasher(),
                ]
            )
        );
        $this->plainPasswordString = 'password';
    }
}
