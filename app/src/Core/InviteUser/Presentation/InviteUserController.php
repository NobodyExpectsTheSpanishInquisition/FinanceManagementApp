<?php

declare(strict_types=1);

namespace App\Core\InviteUser\Presentation;

use App\Core\InviteUser\Application\InviteUserCommand;
use App\Core\InviteUser\Application\InviteUserHandler;
use App\Shared\Presentation\Http\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class InviteUserController extends AbstractController
{
    public function __invoke(
        string $accountId,
        Request $request,
        InviteUserRequestMapper $requestMapper,
        InviteUserHandler $handler
    ): JsonResponse {
        try {
            $inviteUserRequest = $requestMapper->map($request, $accountId);

            $handler->handle(
                new InviteUserCommand(
                    $inviteUserRequest->accountId,
                    $inviteUserRequest->userId,
                    $inviteUserRequest->email,
                    $inviteUserRequest->firstName,
                    $inviteUserRequest->lastName
                )
            );
        } catch (Throwable $e) {
            return $this->exceptionConverter->convertToExceptionResponse($e);
        }
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
