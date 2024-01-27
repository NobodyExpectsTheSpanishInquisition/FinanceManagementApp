<?php

declare(strict_types=1);

namespace App\Tests;

enum TestHttpStatusCode: int
{
    case UNPROCESSABLE_ENTITY = 422;
    case BAD_REQUEST = 401;
    case CREATED = 201;
}
