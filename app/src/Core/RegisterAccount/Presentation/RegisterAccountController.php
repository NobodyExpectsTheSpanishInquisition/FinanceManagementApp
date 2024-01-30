<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Presentation;

use App\Core\RegisterAccount\Application\RegisterAccountCommand;
use App\Core\RegisterAccount\Application\RegisterAccountHandler;
use App\Shared\Presentation\Http\AbstractController;
use App\Shared\Presentation\HttpStatusCode;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

final class RegisterAccountController extends AbstractController
{
    public function register(RegisterAccountHandler $handler): JsonResponse
    {
        try {
            $handler->handle(new RegisterAccountCommand());
        } catch (Exception $e) {
            return $this->exceptionConverter->convertToJsonResponse($e);
        }

        return new JsonResponse(null, HttpStatusCode::CREATED->value);
    }
}
