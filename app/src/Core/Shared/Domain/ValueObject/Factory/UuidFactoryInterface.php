<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject\Factory;

use App\Core\Shared\Domain\ValueObject\Exception\CannotCreateUuidException;
use App\Core\Shared\Domain\ValueObject\Uuid;

interface UuidFactoryInterface
{
    /**
     * @throws CannotCreateUuidException
     */
    public function fromString(string $uuid): Uuid;
}
