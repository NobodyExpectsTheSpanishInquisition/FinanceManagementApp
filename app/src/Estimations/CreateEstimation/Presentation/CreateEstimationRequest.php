<?php

declare(strict_types=1);

namespace App\Estimations\CreateEstimation\Presentation;

use App\Estimations\Shared\Domain\ValueObject\AccountId;
use App\Estimations\Shared\Domain\ValueObject\EstimationId;
use App\Estimations\Shared\Domain\ValueObject\EstimationType;
use App\Estimations\Shared\Domain\ValueObject\OwnerId;
use App\Estimations\Shared\Domain\ValueObject\Title;
use App\Shared\Infrastructure\Request\RequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class CreateEstimationRequest implements RequestInterface
{
    public const ID = 'id';

    public const TITLE = 'title';

    public const ACCOUNT_ID = 'accountId';

    public const OWNER_ID = 'ownerId';

    public const TYPE = 'type';

    public function __construct(
        #[Assert\Valid] public EstimationId $id,
        #[Assert\Valid] public AccountId $accountId,
        #[Assert\Valid] public OwnerId $ownerId,
        #[Assert\Valid] public EstimationType $type,
        #[Assert\Valid] public Title $title
    ) {
    }
}
