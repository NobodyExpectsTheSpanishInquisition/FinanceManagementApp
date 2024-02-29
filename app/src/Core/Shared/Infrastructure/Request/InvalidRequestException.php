<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Request;

use Exception;
use Symfony\Component\HttpFoundation\Response;

final class InvalidRequestException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message, Response::HTTP_BAD_REQUEST);
    }
}
