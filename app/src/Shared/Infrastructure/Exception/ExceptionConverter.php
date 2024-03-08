<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Exception;

use App\Shared\Presentation\Http\ExceptionResponse;
use Throwable;

final readonly class ExceptionConverter
{
    public function convertToExceptionResponse(Throwable $exception): ExceptionResponse
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
