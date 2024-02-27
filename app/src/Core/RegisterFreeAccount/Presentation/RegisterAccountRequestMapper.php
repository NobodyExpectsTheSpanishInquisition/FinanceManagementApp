<?php

declare(strict_types=1);

namespace App\Core\RegisterFreeAccount\Presentation;

use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UserId;
use App\Core\Shared\Infrastructure\ValueObject\PlainPassword;
use Symfony\Component\HttpFoundation\Request;

final readonly class RegisterAccountRequestMapper
{
    public function map(Request $request): RegisterAccountRequest
    {
        $content = json_decode(json: $request->getContent(), associative: true);
        $userContent = $content[RegisterAccountRequest::USER_KEY];

        return new RegisterAccountRequest(
            new AccountId($content[RegisterAccountRequest::ACCOUNT_ID_KEY]),
            new UserId($userContent[RegisterAccountRequest::USER_ID_KEY]),
            new FirstName($userContent[RegisterAccountRequest::FIRST_NAME_KEY]),
            new LastName($userContent[RegisterAccountRequest::LAST_NAME_KEY]),
            new Email($userContent[RegisterAccountRequest::EMAIL_KEY]),
            new PlainPassword($userContent[RegisterAccountRequest::PASSWORD_KEY]),
            AccountType::from($content[RegisterAccountRequest::ACCOUNT_TYPE_KEY])
        );
    }
}
