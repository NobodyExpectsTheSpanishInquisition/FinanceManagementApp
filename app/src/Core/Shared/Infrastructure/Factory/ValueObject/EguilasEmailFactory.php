<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Factory\ValueObject;

use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\Exception\CannotCreateEmailException;
use App\Core\Shared\Domain\ValueObject\Factory\EmailFactoryInterface;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\Extra\SpoofCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\NoRFCWarningsValidation;
use Egulias\EmailValidator\Validation\RFCValidation;

final readonly class EguilasEmailFactory implements EmailFactoryInterface
{
    public function __construct(private EmailValidator $emailValidator)
    {
    }

    /**
     * @inheritDoc
     */
    public function fromString(string $email): Email
    {
        if (
            false === $this->emailValidator->isValid(
                $email,
                new MultipleValidationWithAnd(
                    [
                        new RFCValidation(),
                        new NoRFCWarningsValidation(),
                    ]
                )
            )
        ) {
            throw CannotCreateEmailException::becauseEmailIsInvalid($email);
        }

        return new Email($email);
    }
}
