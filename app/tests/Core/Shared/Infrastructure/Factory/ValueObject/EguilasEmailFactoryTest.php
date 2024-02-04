<?php

namespace App\Tests\Core\Shared\Infrastructure\Factory\ValueObject;

use App\Core\Shared\Domain\ValueObject\Exception\CannotCreateEmailException;
use App\Core\Shared\Infrastructure\Factory\ValueObject\EguilasEmailFactory;
use App\Tests\UnitTestCase;
use Egulias\EmailValidator\EmailValidator;

final class EguilasEmailFactoryTest extends UnitTestCase
{
    private EguilasEmailFactory $emailFactory;

    public function test_FromString_ShouldCreateInstanceOfEmail_WhenProvidedStringMetRFC5322Requirements(): void
    {
        $validEmail = 'example@test.com';

        $createdEmail = $this->emailFactory->fromString($validEmail);

        self::assertEquals($validEmail, $createdEmail->email);
    }

    public function test_FromString_ShouldThrowException_WhenLocalPartBeginsWithDot(): void
    {
        $invalidEmail = '.example@test.com';

        $this->expectExceptionObject(CannotCreateEmailException::becauseEmailIsInvalid($invalidEmail));
        $this->emailFactory->fromString($invalidEmail);
    }

    public function test_FromString_ShouldThrowException_WhenLocalPartEndsWithDot(): void
    {
        $invalidEmail = 'example.@test.com';

        $this->expectExceptionObject(CannotCreateEmailException::becauseEmailIsInvalid($invalidEmail));
        $this->emailFactory->fromString($invalidEmail);
    }

    public function test_FromString_ShouldThrowException_WhenDomainPartBeginsWithDot(): void
    {
        $invalidEmail = 'example@.test.com';

        $this->expectExceptionObject(CannotCreateEmailException::becauseEmailIsInvalid($invalidEmail));
        $this->emailFactory->fromString($invalidEmail);
    }

    public function test_FromString_ShouldThrowException_WhenDomainPartEndsWithDot(): void
    {
        $invalidEmail = 'example@test.com.';

        $this->expectExceptionObject(CannotCreateEmailException::becauseEmailIsInvalid($invalidEmail));
        $this->emailFactory->fromString($invalidEmail);
    }

    public function test_FromString_ShouldThrowException_WhenDomainPartLastSegmentDoesNotContainDot(): void
    {
        $invalidEmail = 'example@testcom';

        $this->expectExceptionObject(CannotCreateEmailException::becauseEmailIsInvalid($invalidEmail));
        $this->emailFactory->fromString($invalidEmail);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->emailFactory = new EguilasEmailFactory(new EmailValidator());
    }
}
