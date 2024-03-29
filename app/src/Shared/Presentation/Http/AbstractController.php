<?php

declare(strict_types=1);

namespace App\Shared\Presentation\Http;

use App\Core\Shared\Infrastructure\Request\RequestValidatorInterface;
use App\Shared\Infrastructure\Exception\ExceptionConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

abstract class AbstractController extends SymfonyAbstractController
{
    public function __construct(
        protected ExceptionConverter $exceptionConverter,
        protected RequestValidatorInterface $requestValidator
    ) {
    }
}
