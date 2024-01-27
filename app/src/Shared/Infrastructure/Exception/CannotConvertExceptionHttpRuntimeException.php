<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Exception;

use App\Shared\Presentation\Http\StatusCode;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class CannotConvertExceptionHttpRuntimeException extends HttpException
{
    public static function becauseUnknownExceptionThrown(string $exceptionClassName): self
    {
        return new self(
            statusCode: StatusCode::INTERNAL_SERVER_ERROR->value,
            message   : sprintf(
                'Cannot convert %s to HTTP exception. Unknown exception thrown.',
                $exceptionClassName
            ),
        );
    }
}
