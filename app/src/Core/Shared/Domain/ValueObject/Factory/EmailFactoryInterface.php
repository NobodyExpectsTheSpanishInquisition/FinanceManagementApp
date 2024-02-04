<?php

declare(strict_types=1);

namespace App\Core\Shared\Domain\ValueObject\Factory;

use App\Core\Shared\Domain\ValueObject\Email;
use App\Core\Shared\Domain\ValueObject\Exception\CannotCreateEmailException;

interface EmailFactoryInterface
{
    /**
     * @throws CannotCreateEmailException
     */
    public function fromString(string $email): Email;
}
