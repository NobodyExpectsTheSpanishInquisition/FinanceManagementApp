<?php

declare(strict_types=1);

namespace App\Tests\Core\InviteUser\Presentation;

final readonly class InviteUserControllerTestData
{
    public function getRouteName(): string
    {
        return 'api.core.accounts.invite.user';
    }

    /**
     * @return array<string, string>
     */
    public function getUrlParams(): array
    {
        return ['accountId' => $this->getAccountId()];
    }

    public function loadData(): void
    {
    }

    /**
     * @return array<string, string>
     */
    public function getContent(): array
    {
        return [
            'id' => '9DE361C5-7B65-4E5C-B196-21502DC010C1',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'invited.user@email.com',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function getInvalidContent(): array
    {
        return [
            'id' => '9DE361C5-7B65-4E5C-B196-',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'invited.user@email.com',
        ];
    }

    private function getAccountId(): string
    {
        return 'BB6FDF02-53F4-419A-8F27-2B8449CFB9F3';
    }
}
