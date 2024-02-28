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

final readonly class RegisterFreeAccountRequestMapper
{
    public function map(Request $request): RegisterFreeAccountRequest
    {
        $content = json_decode(json: $request->getContent(), associative: true);
        $userContent = $content[RegisterFreeAccountRequest::USER_KEY];

        return new RegisterFreeAccountRequest(
            new AccountId($content[RegisterFreeAccountRequest::ACCOUNT_ID_KEY]),
            new UserId($userContent[RegisterFreeAccountRequest::USER_ID_KEY]),
            new FirstName($userContent[RegisterFreeAccountRequest::FIRST_NAME_KEY]),
            new LastName($userContent[RegisterFreeAccountRequest::LAST_NAME_KEY]),
            new Email($userContent[RegisterFreeAccountRequest::EMAIL_KEY]),
            new PlainPassword($userContent[RegisterFreeAccountRequest::PASSWORD_KEY]),
            AccountType::from($content[RegisterFreeAccountRequest::ACCOUNT_TYPE_KEY])
        );
    }
}
