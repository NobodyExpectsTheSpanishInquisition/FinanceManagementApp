<?php

declare(strict_types=1);

namespace App\Tests;

use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Router;

class SmokeTestCase extends WebTestCase
{
    protected AbstractBrowser $client;
    private Router $router;

    protected function assertResourceCreated(JsonResponse $response): void
    {
        self::assertEquals(TestHttpStatusCode::CREATED->value, $response->getStatusCode());
    }

    /**
     * @param array<string, mixed> $parameters
     * @throws InvalidParameterException
     * @throws MissingMandatoryParametersException
     * @throws RouteNotFoundException
     */
    protected function sendPostRequest(string $routeName, array $parameters): JsonResponse
    {
        $uri = $this->router->generate($routeName);

        $this->client->request(
            method : TestHttpMethod::POST->name,
            uri    : $uri,
            content: json_encode($parameters),
        );

        /** @var JsonResponse */
        return $this->client->getResponse();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = self::createClient();
        try {
            $this->router = $this->client->getContainer()->get('router');
        } catch (ServiceNotFoundException $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
}
