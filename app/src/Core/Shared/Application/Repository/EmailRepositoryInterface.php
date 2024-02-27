<?php

declare(strict_types=1);

namespace App\Core\Shared\Application\Repository;

use App\Core\Shared\Domain\ValueObject\Email;

interface EmailRepositoryInterface
{
    public function exists(Email $email): bool;
}
