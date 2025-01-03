<?php
declare(strict_types=1);

namespace LessValueObjectTest\Enum\Helper;

use PHPUnit\Framework\TestCase;

/**
 * @covers \LessValueObject\Enum\Helper\EnumValueHelper
 */
final class EnumValueHelperTest extends TestCase
{
    public function testProxies(): void
    {
        $stub = new EnumValueHelperStub();

        self::assertSame('fiz', $stub->getValue());
        self::assertSame('fiz', $stub->jsonSerialize());
    }
}
