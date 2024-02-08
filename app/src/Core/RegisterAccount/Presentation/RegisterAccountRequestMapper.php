<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Presentation;

use App\Core\Shared\Domain\ValueObject\Factory\EmailFactoryInterface;
use App\Core\Shared\Domain\ValueObject\Factory\HashedPasswordFactoryInterface;
use App\Core\Shared\Domain\ValueObject\Factory\UuidFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

final readonly class RegisterAccountRequestMapper
{
    public function __construct(
        private UuidFactoryInterface $uuidFactory,
        private EmailFactoryInterface $emailFactory,
        private HashedPasswordFactoryInterface $hashedPasswordFactory
    ) {
    }

    public function map(Request $request): RegisterAccountRequest
    {
        return new RegisterAccountRequest();
    }
}
