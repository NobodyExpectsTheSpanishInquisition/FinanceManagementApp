<?php

declare(strict_types=1);

namespace App\Tests;

use App\Shared\Presentation\Http\ExceptionResponse;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Router;

class SmokeTestCase extends WebTestCase
{
    protected AbstractBrowser $client;
    private Router $router;

    protected function assertExceptionResponseReturned(JsonResponse $response): void
    {
        self::assertInstanceOf(ExceptionResponse::class, $response);
    }

    protected function assertResourceCreated(JsonResponse $response): void
    {
        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

    protected function assertNoContent(JsonResponse $response): void
    {
        self::assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
    }

    /**
     * @param array<string, mixed> $content
     * @param array<string, mixed> $parameters
     * @throws InvalidParameterException
     * @throws MissingMandatoryParametersException
     * @throws RouteNotFoundException
     */
    protected function sendPostRequest(string $routeName, array $content, array $parameters = []): JsonResponse
    {
        $uri = $this->router->generate($routeName, $parameters);

        $this->client->request(
            method : Request::METHOD_POST,
            uri    : $uri,
            content: json_encode($content)
        );

        /** @var JsonResponse */
        return $this->client->getResponse();
    }

    /**
     * @param array<string, mixed> $content
     * @param array<string, mixed> $parameters
     * @throws InvalidParameterException
     * @throws MissingMandatoryParametersException
     * @throws RouteNotFoundException
     */
    protected function sentPutRequest(string $routeName, array $content, array $parameters = []): JsonResponse
    {
        $uri = $this->router->generate($routeName, $parameters);

        $jsonContent = json_encode($content);
        if (false === is_string($jsonContent) || false === json_validate($jsonContent)) {
            throw new RuntimeException('Invalid content passed. Cannot be serialized to json.');
        }

        $this->client->request(
            method : Request::METHOD_PUT,
            uri    : $uri,
            content: $jsonContent
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
