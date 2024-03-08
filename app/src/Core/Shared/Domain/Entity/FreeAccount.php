<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Entity;

use App\Core\InviteUser\Domain\CannotInviteUserException;
use App\Core\Shared\Domain\Entity\Factory\UserFactory;
use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UserId;
use App\Shared\Domain\Event\EventQueueInterface;
use App\Shared\Domain\ValueObject\CreatedAt;

final readonly class FreeAccount extends Account
{
    public function __construct(AccountId $id, private User $user, CreatedAt $createdAt)
    {
        parent::__construct($id, AccountType::FREE, $this->user, $createdAt);
    }

    /**
     * @throws CannotInviteUserException
     */
    public function inviteUser(
        UserId $userId,
        FirstName $firstName,
        LastName $lastName,
        Email $email,
        UserFactory $userFactory,
        EventQueueInterface $eventQueue
    ): void {
        throw CannotInviteUserException::becauseFreeAccountCanHaveOnlyOneUser();
    }
}
