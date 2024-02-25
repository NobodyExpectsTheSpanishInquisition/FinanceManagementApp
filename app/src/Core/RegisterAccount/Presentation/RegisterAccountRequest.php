<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Presentation;

use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UserId;
use App\Core\Shared\Infrastructure\Request\RequestInterface;
use App\Core\Shared\Infrastructure\ValueObject\PlainPassword;
use Symfony\Component\Validator\Constraints as Assert;


final readonly class RegisterAccountRequest implements RequestInterface
{
    public const ACCOUNT_ID_KEY = 'id';
    public const USER_ID_KEY = 'userId';
    public const FIRST_NAME_KEY = 'firstName';
    public const LAST_NAME_KEY = 'lastName';
    public const EMAIL_KEY = 'email';
    public const PASSWORD_KEY = 'password';
    public const ACCOUNT_TYPE_KEY = 'accountType';

    public function __construct(
        #[Assert\Valid] public AccountId $accountId,
        #[Assert\Valid] public UserId $userId,
        #[Assert\Valid] public FirstName $firstName,
        #[Assert\Valid] public LastName $lastName,
        #[Assert\Valid] public Email $email,
        #[Assert\Valid] public PlainPassword $password,
        #[Assert\Valid] public AccountType $accountType
    )
    {
    }
}
