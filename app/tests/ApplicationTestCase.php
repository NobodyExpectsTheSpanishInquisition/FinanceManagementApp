<?php

declare(strict_types=1);

namespace App\Tests;

use App\Core\Shared\Application\Event\EventDispatcherInterface;
use App\Tests\Spy\EventDispatcherSpy;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

class ApplicationTestCase extends KernelTestCase
{
    protected Container $container;

    protected function getEventDispatcherSpy(): EventDispatcherSpy
    {
        return $this->container->get(EventDispatcherInterface::class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = self::getContainer();
    }
}
