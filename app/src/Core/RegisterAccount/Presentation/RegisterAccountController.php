<?php

declare(strict_types=1);

namespace App\Core\RegisterAccount\Presentation;

use App\Shared\Presentation\HttpStatusCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class RegisterAccountController extends AbstractController
{
    public function register(): JsonResponse
    {
        return new JsonResponse(null, HttpStatusCode::CREATED->value);
    }
}
