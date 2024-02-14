<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Request;

use App\Shared\Presentation\Http\StatusCode;
use Exception;

final class InvalidRequestException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message, StatusCode::BAD_REQUEST->value);
    }
}
