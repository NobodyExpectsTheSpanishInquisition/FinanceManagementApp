<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Exception;

use App\Shared\Presentation\Http\ExceptionResponse;
use Exception;

final readonly class ExceptionConverter
{
    public function convertToExceptionResponse(Exception $exception): ExceptionResponse
    {
        return new ExceptionResponse(
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
