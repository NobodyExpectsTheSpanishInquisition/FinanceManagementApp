<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Exception;

use App\Shared\Presentation\Http\StatusCode;
use Exception;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

final readonly class ExceptionConverter
{
    /**
     * @throws CannotConvertExceptionHttpRuntimeException
     */
    public function convert(Exception $exception): HttpException
    {
        return match (true) {
            $exception instanceof RequestException => new BadRequestHttpException($exception->getMessage()),
            default => throw CannotConvertExceptionHttpRuntimeException::becauseUnknownExceptionThrown(
                $exception::class
            )
        };
    }
}
