<?php

declare(strict_types=1);

namespace App\Estimations\CreateEstimation\Presentation;

use App\Estimations\CreateEstimation\Application\CreateEstimationCommand;
use App\Estimations\CreateEstimation\Application\CreateEstimationHandler;
use App\Shared\Presentation\Http\AbstractController;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateEstimationController extends AbstractController
{
    public function __invoke(
        string $accountId,
        Request $request,
        CreateEstimationRequestMapper $requestMapper,
        CreateEstimationHandler $handler
    ): JsonResponse {
        try {
            $createEstimationRequest = $requestMapper->map($request, $accountId);

            $this->requestValidator->assertRequestIsValid($createEstimationRequest);

            $handler->handle(
                new CreateEstimationCommand(
                    $createEstimationRequest->id,
                    $createEstimationRequest->accountId,
                    $createEstimationRequest->ownerId,
                    $createEstimationRequest->type,
                    $createEstimationRequest->title
                )
            );
        } catch (Exception $e) {
            return $this->exceptionConverter->convertToExceptionResponse($e);
        }

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
