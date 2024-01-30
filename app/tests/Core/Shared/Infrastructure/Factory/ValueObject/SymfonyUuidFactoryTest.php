<?php

namespace App\Tests\Core\Shared\Infrastructure\Factory\ValueObject;

use App\Core\Shared\Domain\ValueObject\Exception\CannotCreateUuidException;
use App\Core\Shared\Infrastructure\Factory\ValueObject\SymfonyUuidFactory;
use PHPUnit\Framework\TestCase;

class SymfonyUuidFactoryTest extends TestCase
{
    private SymfonyUuidFactory $factory;

    public function testFromStringShouldReturnUuidInstanceWhenStringUuidV4Passed(): void
    {
        $uuidV4String = '52573093-1B4E-419E-8F26-2F5730FEFF72';

        $uuid = $this->factory->fromString($uuidV4String);

        self::assertEquals($uuidV4String, $uuid->uuid);
    }

    public function testFromStringShouldThrowExceptionWhenPassedUuidDoesNotMetRfc4122(): void
    {
        $invalidUuid = '52573093-1B4E-419E-8F26-2F57GHZ';

        $this->expectExceptionObject(CannotCreateUuidException::becauseInvalidValuePassedByRequest($invalidUuid));
        $this->factory->fromString($invalidUuid);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = new SymfonyUuidFactory();
    }
}
