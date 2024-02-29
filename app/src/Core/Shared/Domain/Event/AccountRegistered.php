<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\Event;

use App\Core\Shared\Domain\Entity\Account;
use App\Shared\Domain\Event\EventInterface;
use App\Shared\Domain\Event\EventTimestamp;

final readonly class AccountRegistered implements EventInterface
{
    public function __construct(public Account $account, public EventTimestamp $timestamp)
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'data' => [
                'account' => $this->account->jsonSerialize(),
            ],
            'timestamp' => $this->timestamp->toString(),
        ];
    }
}
