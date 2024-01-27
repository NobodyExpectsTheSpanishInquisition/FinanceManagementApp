<?php

declare(strict_types=1);

namespace App\Tests;

enum TestStatusCode: int
{
    case INTERNAL_SERVER_ERROR = 500;
}
