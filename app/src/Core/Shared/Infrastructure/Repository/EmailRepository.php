<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Repository;

use App\Core\Shared\Application\Repository\EmailRepositoryInterface;
use App\Core\Shared\Domain\ValueObject\Email;

final readonly class EmailRepository implements EmailRepositoryInterface
{
    /**
     * @TODO implement when create datahub
     */
    public function exists(Email $email): bool
    {
        return false;
    }
}
