<?php

declare(strict_types=1);

namespace App\Estimations\CreateEstimation\Application;

use App\Core\Shared\Application\Event\EventDispatcherInterface;
use App\Estimations\CreateEstimation\Domain\CannotCreateEstimationException;
use App\Estimations\CreateEstimation\Domain\CreateEstimationAssertionInterface;
use App\Estimations\Shared\Domain\Entity\Factory\EstimationFactory;
use App\Estimations\Shared\Domain\Event\EstimationCreated;
use App\Shared\Domain\Clock\ClockException;
use App\Shared\Domain\Clock\ClockInterface;
use App\Shared\Domain\Event\EventTimestamp;
use App\Shared\Domain\ValueObject\CreatedAt;
use App\Shared\Domain\ValueObject\UpdatedAt;

final readonly class CreateEstimationHandler
{
    public function __construct(
        private EstimationFactory $estimationFactory,
        private ClockInterface $clock,
        private CreateEstimationAssertionInterface $assertion,
        private EventDispatcherInterface $eventDispatcher
    ) {
    }

    /**
     * @throws ClockException
     * @throws CannotCreateEstimationException
     */
    public function handle(CreateEstimationCommand $command): void
    {
        $this->assertion->assert($command->accountId);

        $now = $this->clock->now();
        $createdAt = new CreatedAt($now);
        $updatedAt = new UpdatedAt($now);

        $estimation = $this->estimationFactory->create(
            $command->id,
            $command->accountId,
            $command->ownerId,
            $command->title,
            $command->type,
            $createdAt,
            $updatedAt
        );

        $this->eventDispatcher->push(new EstimationCreated($estimation, new EventTimestamp($now)));
        $this->eventDispatcher->dispatch();
    }
}
