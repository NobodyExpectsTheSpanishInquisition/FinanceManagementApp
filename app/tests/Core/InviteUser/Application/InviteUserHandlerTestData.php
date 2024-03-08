<?php

declare(strict_types=1);

namespace App\Tests\Core\InviteUser\Application;

use App\Core\InviteUser\Application\InviteUserCommand;
use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UserId;

final readonly class InviteUserHandlerTestData
{
    public function getCommand(): InviteUserCommand
    {
        return new InviteUserCommand(
            $this->getAccountId(),
            new UserId('CC6C59BA-3D02-4880-B009-7CC0B94C295F'),
            new Email('test@email.com'),
            new FirstName('test firstName'),
            new LastName('test lastName')
        );
    }

    public function getAccountId(): AccountId
    {
        return new AccountId('3BD0747F-181E-46E6-9851-0FD392C034F1');
    }
}
