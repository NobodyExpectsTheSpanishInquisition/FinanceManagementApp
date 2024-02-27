<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Exception;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

final readonly class ExceptionConverter
{
    public function convertToJsonResponse(Exception $exception): JsonResponse
    {
        return new JsonResponse(
            [
                'error' => [
                    'message' => $exception->getMessage(),
                    'statusCode' => $exception->getCode(),
                ],
            ],
            $exception->getCode()
        );
    }
}
