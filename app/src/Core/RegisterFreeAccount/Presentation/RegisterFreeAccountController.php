<?php

declare(strict_types=1);

namespace App\Core\RegisterFreeAccount\Presentation;

use App\Core\RegisterFreeAccount\Application\RegisterFreeAccountCommand;
use App\Core\RegisterFreeAccount\Application\RegisterFreeAccountHandler;
use App\Shared\Presentation\Http\AbstractController;
use App\Shared\Presentation\HttpStatusCode;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class RegisterFreeAccountController extends AbstractController
{
    public function register(
        Request $request,
        RegisterFreeAccountRequestMapper $requestMapper,
        RegisterFreeAccountHandler $registerFreeAccountHandler
    ): JsonResponse {
        $registerAccountRequest = $requestMapper->map($request);

        try {
            $this->requestValidator->assertRequestIsValid($registerAccountRequest);

            $registerFreeAccountHandler->handle(
                new RegisterFreeAccountCommand(
                    $registerAccountRequest->accountId,
                    $registerAccountRequest->userId,
                    $registerAccountRequest->firstName,
                    $registerAccountRequest->lastName,
                    $registerAccountRequest->email,
                    $registerAccountRequest->password,
                )
            );
        } catch (Exception $e) {
            return $this->exceptionConverter->convertToJsonResponse($e);
        }

        return new JsonResponse(null, HttpStatusCode::CREATED->value);
    }
}
