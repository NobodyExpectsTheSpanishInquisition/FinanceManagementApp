<?php

declare(strict_types=1);

namespace App\Estimations\CreateEstimation\Presentation;

use App\Estimations\Shared\Domain\ValueObject\AccountId;
use App\Estimations\Shared\Domain\ValueObject\EstimationId;
use App\Estimations\Shared\Domain\ValueObject\EstimationType;
use App\Estimations\Shared\Domain\ValueObject\OwnerId;
use App\Estimations\Shared\Domain\ValueObject\Title;
use Symfony\Component\HttpFoundation\Request;

final readonly class CreateEstimationRequestMapper
{
    public function map(Request $request, string $accountId): CreateEstimationRequest
    {
        $content = json_decode(json: $request->getContent(), associative: true);

        return new CreateEstimationRequest(
            new EstimationId($content[CreateEstimationRequest::ID]),
            new AccountId($accountId),
            new OwnerId($content[CreateEstimationRequest::OWNER_ID]),
            EstimationType::from($content[CreateEstimationRequest::TYPE]),
            new Title($content[CreateEstimationRequest::TITLE])
        );
    }
}
