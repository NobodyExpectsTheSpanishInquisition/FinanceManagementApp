<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject\Factory;

use App\Core\Shared\Domain\ValueObject\Exception\CannotHashPasswordException;
use App\Core\Shared\Domain\ValueObject\HashedPassword;
use App\Core\Shared\Infrastructure\ValueObject\PlainPassword;

interface HashedPasswordFactoryInterface
{

    /**
     * @throws CannotHashPasswordException
     */
    public function fromPlainPassword(PlainPassword $plainPassword): HashedPassword;
}
