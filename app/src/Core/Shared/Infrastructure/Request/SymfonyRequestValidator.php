<?php

declare(strict_types=1);

namespace App\Core\Shared\Infrastructure\Request;

use Symfony\Component\Validator\Validator\ValidatorInterface;

final readonly class SymfonyRequestValidator implements RequestValidatorInterface
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    /**
     * @inheritDoc
     */
    public function assertRequestIsValid(RequestInterface $request): void
    {
        $violations = $this->validator->validate($request);

        if (0 === $violations->count()) {
            return;
        }

        throw new InvalidRequestException($violations->get(0)->getMessage());
    }
}
