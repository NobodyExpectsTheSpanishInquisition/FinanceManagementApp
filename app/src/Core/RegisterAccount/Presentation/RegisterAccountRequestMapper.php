<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Presentation;

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

        return new RegisterAccountRequest(
            new AccountId($content[RegisterAccountRequest::ACCOUNT_ID_KEY]),
            new UserId($content[RegisterAccountRequest::USER_ID_KEY]),
            new FirstName($content[RegisterAccountRequest::FIRST_NAME_KEY]),
            new LastName($content[RegisterAccountRequest::LAST_NAME_KEY]),
            new Email($content[RegisterAccountRequest::EMAIL_KEY]),
            new PlainPassword($request[RegisterAccountRequest::PASSWORD_KEY]),
            AccountType::from($content[RegisterAccountRequest::ACCOUNT_TYPE_KEY])
        );
    }
}
