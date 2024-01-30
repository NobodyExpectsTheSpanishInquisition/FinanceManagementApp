<?php

declare(strict_types=1);

namespace App\Tests;

use DG\BypassFinals;
use PHPUnit\Framework\TestCase;

class UnitTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        BypassFinals::enable();
    }
}
