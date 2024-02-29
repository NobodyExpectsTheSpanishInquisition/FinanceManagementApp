<?php

declare(strict_types=1);

namespace App\Estimations\CreateEstimation\Domain;

use Exception;

final class CannotCreateEstimationException extends Exception
{
    public static function becauseUserExceededAllowedEstimationAmount(): self
    {
        return new self(
            'Cannot create estimation. You exceeded number of estimations for your account type.',
            422
        );
    }
}
