<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject\Factory;

use App\Core\Shared\Domain\ValueObject\Exception\CannotCreatePasswordException;
use App\Core\Shared\Domain\ValueObject\HashedPassword;

interface HashedPasswordFactoryInterface
{
    /**
     * @throws CannotCreatePasswordException
     */
    public function fromString(string $plainPasswordString): HashedPassword;
}
