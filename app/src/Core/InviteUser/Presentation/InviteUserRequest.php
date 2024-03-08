<?php

declare(strict_types=1);

namespace App\Core\InviteUser\Presentation;

use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UserId;

final readonly class InviteUserRequest
{
    public const USER_ID = 'id';

    public const EMAIL = 'email';

    public const FIRST_NAME = 'firstName';

    public const LAST_NAME = 'lastName';

    public function __construct(
        public UserId $userId,
        public AccountId $accountId,
        public Email $email,
        public FirstName $firstName,
        public LastName $lastName
    ) {
    }
}
