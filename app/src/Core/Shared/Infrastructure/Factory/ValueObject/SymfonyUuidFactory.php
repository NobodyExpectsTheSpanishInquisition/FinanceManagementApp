<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Factory\ValueObject;

use App\Core\Shared\Domain\ValueObject\Exception\CannotCreateUuidException;
use App\Core\Shared\Domain\ValueObject\Factory\UuidFactoryInterface;
use App\Core\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

final readonly class SymfonyUuidFactory implements UuidFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function fromString(string $uuid): Uuid
    {
        if (false === SymfonyUuid::isValid($uuid)) {
            throw CannotCreateUuidException::becauseInvalidValuePassedByRequest($uuid);
        }

        return new Uuid(strtoupper((SymfonyUuid::fromString($uuid))->toRfc4122()));
    }
}
