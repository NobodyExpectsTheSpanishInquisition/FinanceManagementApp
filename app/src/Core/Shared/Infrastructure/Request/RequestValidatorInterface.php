<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Request;

use App\Shared\Infrastructure\Request\RequestInterface;

interface RequestValidatorInterface
{
    /**
     * @throws InvalidRequestException
     */
    public function assertRequestIsValid(RequestInterface $request): void;
}
