<?php

declare(strict_types=1);

namespace App\Tests\Core\RegisterAccount\Presentation;

use App\Core\Shared\Domain\ValueObject\AccountType;

final readonly class RegisterAccountControllerTestData
{
    private const ROUTE_NAME = 'api.core.accounts.register';

    public function getRouteName(): string
    {
        return self::ROUTE_NAME;
    }

    /**
     * @return array<string, mixed>
     */
    public function getParameters(): array
    {
        return [
            'id' => 'D6501AF8-26D1-421B-8002-64C0D80A28E1',
            'accountType' => AccountType::FREE->name,
            'user' => [
                'id' => '8BCC4F4F-5257-4AAC-B445-F01E842038CB',
                'firstName' => 'John',
                'lastName' => 'Doe',
                'email' => 'john.doe@email.com'
            ]
        ];
    }
}
