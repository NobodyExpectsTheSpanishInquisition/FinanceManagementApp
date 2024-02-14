<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Presentation;

use App\Core\RegisterAccount\Application\RegisterAccountCommand;
use App\Core\RegisterAccount\Application\RegisterAccountHandler;
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
        RegisterAccountHandler $handler
    ): JsonResponse
    {
        $registerAccountRequest = $requestMapper->map($request);

        try {
            $this->requestValidator->assertRequestIsValid($registerAccountRequest);

            $handler->handle(new RegisterAccountCommand());
        } catch (Exception $e) {
            return $this->exceptionConverter->convertToJsonResponse($e);
        }

        return new JsonResponse(null, HttpStatusCode::CREATED->value);
    }
}
