<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Request;

interface RequestValidatorInterface
{
    /**
     * @throws InvalidRequestException
     */
    public function assertRequestIsValid(RequestInterface $request): void;
}
