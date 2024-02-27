<?php

declare(strict_types=1);

namespace App\Core\RegisterFreeAccount\Presentation;

use App\Core\RegisterFreeAccount\Application\CannotRegisterAccountException;
use App\Core\RegisterFreeAccount\Application\RegisterFreeAccountCommand;
use App\Core\RegisterFreeAccount\Application\RegisterFreeAccountHandler;
use App\Core\Shared\Domain\ValueObject\AccountType;
use App\Shared\Presentation\Http\AbstractController;
use App\Shared\Presentation\HttpStatusCode;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class RegisterAccountController extends AbstractController
{
    public function register(
        Request $request,
        RegisterAccountRequestMapper $requestMapper,
        RegisterFreeAccountHandler $registerFreeAccountHandler
    ): JsonResponse {
        $registerAccountRequest = $requestMapper->map($request);

        try {
            $this->requestValidator->assertRequestIsValid($registerAccountRequest);

            $accountType = $registerAccountRequest->accountType;
            match ($accountType) {
                AccountType::FREE => $registerFreeAccountHandler->handle(
                    new RegisterFreeAccountCommand(
                        $registerAccountRequest->accountId,
                        $registerAccountRequest->userId,
                        $registerAccountRequest->firstName,
                        $registerAccountRequest->lastName,
                        $registerAccountRequest->email,
                        $registerAccountRequest->password,
                    )
                ),
            };
        } catch (Exception $e) {
            return $this->exceptionConverter->convertToJsonResponse($e);
        }

        return new JsonResponse(null, HttpStatusCode::CREATED->value);
    }
}
