<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Presentation;

use Symfony\Component\HttpFoundation\Request;

final readonly class RegisterAccountRequestMapper
{
    public function map(Request $request): RegisterAccountRequest
    {
        return new RegisterAccountRequest();
    }
}
