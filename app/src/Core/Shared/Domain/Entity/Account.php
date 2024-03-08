<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Entity;

use App\Core\Shared\Domain\Entity\Factory\UserFactory;
use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UserId;
use App\Shared\Domain\Event\EventQueueInterface;
use App\Shared\Domain\ValueObject\CreatedAt;
use JsonSerializable;

abstract readonly class Account implements JsonSerializable
{
    /**
     * @var array<int, User>
     */
    protected array $users;

    public function __construct(
        protected AccountId $id,
        protected AccountType $accountType,
        protected User $mainUser,
        protected CreatedAt $createdAt
    ) {
        $this->users = [];
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id->uuid,
            'type' => $this->accountType->value,
            'createdAt' => $this->createdAt->toString(),
        ];
    }

    abstract public function inviteUser(
        UserId $userId,
        FirstName $firstName,
        LastName $lastName,
        Email $email,
        UserFactory $userFactory,
        EventQueueInterface $eventQueue
    ): void;
}
