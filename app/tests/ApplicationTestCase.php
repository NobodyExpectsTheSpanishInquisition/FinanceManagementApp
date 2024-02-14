<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

class ApplicationTestCase extends KernelTestCase
{
    protected Container $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = self::getContainer();
    }
}
