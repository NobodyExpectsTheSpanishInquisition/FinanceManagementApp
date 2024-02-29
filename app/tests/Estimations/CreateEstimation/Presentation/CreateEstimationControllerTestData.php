<?php

declare(strict_types=1);

namespace App\Tests\Estimations\CreateEstimation\Presentation;

use App\Estimations\CreateEstimation\Presentation\CreateEstimationRequest;
use App\Estimations\Shared\Domain\ValueObject\EstimationType;

final readonly class CreateEstimationControllerTestData
{
    /**
     * @return array<string, string>
     */
    public function getQueryParams(): array
    {
        return [CreateEstimationRequest::ACCOUNT_ID => $this->getAccountId()];
    }

    public function getRoute(): string
    {
        return 'api.estimations.create';
    }

    /**
     * @return array<string, string>
     */
    public function getValidRequestParams(): array
    {
        return [
            CreateEstimationRequest::ID => 'C4E25CCD-A74A-4E44-96C8-D702D7F80975',
            CreateEstimationRequest::OWNER_ID => $this->getOwnerId(),
            CreateEstimationRequest::TITLE => 'test title',
            CreateEstimationRequest::TYPE => EstimationType::HOME_BUDGET->value,
        ];
    }

    /**
     * @return array<string, string>
     */
    public function getInvalidRequestParams(): array
    {
        return [
            CreateEstimationRequest::ID => 'CCD-A74A-4E44-96C8-D702D7F80975',
            CreateEstimationRequest::OWNER_ID => $this->getOwnerId(),
            CreateEstimationRequest::TITLE => 'test title',
            CreateEstimationRequest::TYPE => EstimationType::HOME_BUDGET->value,
        ];
    }

    /**
     * @TODO IMPLEMENT AFTER DATA HUB
     */
    public function loadData(): void
    {
    }

    private function getAccountId(): string
    {
        return '74C3DC3E-9205-4A81-A635-07A8E3C2778A';
    }

    private function getOwnerId(): string
    {
        return 'A2B8BD46-6B9D-4D42-B0E3-A10C11E7D3FE';
    }
}
