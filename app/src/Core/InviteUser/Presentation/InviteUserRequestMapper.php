<?php

declare(strict_types=1);

namespace App\Core\InviteUser\Presentation;

use App\Core\Shared\Domain\ValueObject\AccountId;
use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\FirstName;
use App\Core\Shared\Domain\ValueObject\LastName;
use App\Core\Shared\Domain\ValueObject\UserId;
use Symfony\Component\HttpFoundation\Request;

final readonly class InviteUserRequestMapper
{
    public function map(Request $request, string $accountId): InviteUserRequest
    {
        $content = json_decode($request->getContent(), true);

        return new InviteUserRequest(
            new UserId($content[InviteUserRequest::USER_ID]),
            new AccountId($accountId),
            new Email($content[InviteUserRequest::EMAIL]),
            new FirstName($content[InviteUserRequest::FIRST_NAME]),
            new LastName($content[InviteUserRequest::LAST_NAME])
        );
    }
}
