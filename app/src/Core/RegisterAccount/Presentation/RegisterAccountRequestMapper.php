<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Presentation;

use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\Exception\CannotCreateEmailException;
use App\Core\Shared\Domain\ValueObject\Exception\CannotCreatePasswordException;
use App\Core\Shared\Domain\ValueObject\Exception\CannotCreateUuidException;
use App\Core\Shared\Domain\ValueObject\Factory\EmailFactoryInterface;
use App\Core\Shared\Domain\ValueObject\Factory\HashedPasswordFactoryInterface;
use App\Core\Shared\Domain\ValueObject\Factory\UuidFactoryInterface;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use Symfony\Component\HttpFoundation\Request;

final readonly class RegisterAccountRequestMapper
{
    public function __construct(
        private UuidFactoryInterface $uuidFactory,
        private EmailFactoryInterface $emailFactory,
        private HashedPasswordFactoryInterface $hashedPasswordFactory
    ) {
    }

    /**
     * @throws CannotCreatePasswordException
     * @throws CannotCreateUuidException
     * @throws CannotCreateEmailException
     */
    public function map(Request $request): RegisterAccountRequest
    {
        $content = json_decode(json: $request->getContent(), associative: true);

        return new RegisterAccountRequest(
            $this->uuidFactory->fromString($content['id']),
            new FirstName($content['firstName']),
            new LastName($content['lastName']),
            $this->emailFactory->fromString($content['email']),
            $this->hashedPasswordFactory->fromString($content['password']),
            AccountType::from($content['accountType'])
        );
    }
}
