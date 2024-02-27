<?php

declare(strict_types=1);

namespace App\Tests\Core\RegisterFreeAccount\Application;

use App\Core\RegisterFreeAccount\Application\RegisterFreeAccountCommand;
use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UserId;
use App\Core\Shared\Infrastructure\ValueObject\PlainPassword;

final readonly class RegisterAccountHandlerTestData
{
    public function getCommand(): RegisterFreeAccountCommand
    {
        return new RegisterFreeAccountCommand(
            new AccountId('439DD8AD-A770-4DC8-AB97-06036D7F67D0'),
            new UserId('099556E8-4180-4199-8FAE-780F645B2D21'),
            new FirstName('TEST'),
            new LastName('TEST'),
            new Email('test@email.com'),
            new PlainPassword('CF93C12F-83F8-4BCD-A5FE-68C913E20F46'),
        );
    }
}
