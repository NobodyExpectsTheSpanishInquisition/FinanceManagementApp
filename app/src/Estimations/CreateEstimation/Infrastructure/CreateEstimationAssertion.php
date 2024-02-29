<?php

declare(strict_types=1);

namespace App\Estimations\CreateEstimation\Infrastructure;

use App\Estimations\CreateEstimation\Domain\CannotCreateEstimationException;
use App\Estimations\CreateEstimation\Domain\CreateEstimationAssertionInterface;
use App\Estimations\CreateEstimation\Domain\CreateEstimationRule;
use App\Estimations\Shared\Domain\ValueObject\AccountId;

final readonly class CreateEstimationAssertion implements CreateEstimationAssertionInterface
{
    public function __construct(private EstimationAssertionRepositoryInterface $assertionRepository)
    {
    }

    /**
     * @inheritDoc
     */
    public function assert(AccountId $accountId): void
    {
        if ($this->userExceededAllowedEstimationsAmount($accountId)) {
            throw CannotCreateEstimationException::becauseUserExceededAllowedEstimationAmount();
        }
    }

    private function userExceededAllowedEstimationsAmount(AccountId $accountId): bool
    {
        return CreateEstimationRule::FREE_ACCOUNT_ALLOWED_CREATED_ESTIMATIONS <
            $this->assertionRepository->countByAccountId($accountId);
    }
}
