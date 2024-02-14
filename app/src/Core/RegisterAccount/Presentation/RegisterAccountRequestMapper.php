<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Presentation;

use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\Factory\EmailFactoryInterface;
use App\Core\Shared\Domain\ValueObject\Factory\UuidFactoryInterface;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Infrastructure\ValueObject\PlainPassword;
use Symfony\Component\HttpFoundation\Request;

final readonly class RegisterAccountRequestMapper
{
    public function __construct(
        private UuidFactoryInterface $uuidFactory,
        private EmailFactoryInterface $emailFactory,
    ) {
    }

    public function map(Request $request): RegisterAccountRequest
    {
        $content = json_decode(json: $request->getContent(), associative: true);

        return new RegisterAccountRequest(
            $this->uuidFactory->fromString($content[RegisterAccountRequest::ACCOUNT_ID_KEY]),
            new FirstName($content[RegisterAccountRequest::FIRST_NAME_KEY]),
            new LastName($content[RegisterAccountRequest::LAST_NAME_KEY]),
            $this->emailFactory->fromString($content[RegisterAccountRequest::EMAIL_KEY]),
            new PlainPassword($request[RegisterAccountRequest::PASSWORD_KEY]),
            AccountType::from($content[RegisterAccountRequest::ACCOUNT_TYPE_KEY])
        );
    }
}
