<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

class ApplicationTestCase extends KernelTestCase
{
    protected Container $container;
    private EventAssertions $eventAssertions;

    public function getEventAssertions(): EventAssertions
    {
        return $this->eventAssertions;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = self::getContainer();
        $this->eventAssertions = new EventAssertions($this, $this->container->get('messenger.transport.events'));
    }
}
