<?php

declare(strict_types=1);

namespace App\Tests\Stub;

use App\Shared\Infrastructure\Request\RequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class TestRequestStub implements RequestInterface
{
    public function __construct(#[Assert\NotBlank] public string $value)
    {
    }
}
