<?php

declare(strict_types=1);

namespace App\Shared\Presentation\Http;

enum StatusCode: int
{
    case INTERNAL_SERVER_ERROR = 500;
}
