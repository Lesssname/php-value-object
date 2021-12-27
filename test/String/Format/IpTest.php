<?php
declare(strict_types=1);

namespace LessValueObjectTest\String\Format;

use LessValueObject\String\Format\Ip;
use PHPUnit\Framework\TestCase;

/**
 * @covers \LessValueObject\String\Format\Ip
 */
final class IpTest extends TestCase
{
    public function testIsInFormat(): void
    {
        self::assertTrue(Ip::isFormat('0.0.0.0'));
        self::assertTrue(Ip::isFormat('255.255.255.255'));

        self::assertTrue(Ip::isFormat('::'));
        self::assertTrue(Ip::isFormat('0000:0000:0000:0000:0000:0000:0000:0000'));
        self::assertTrue(Ip::isFormat('abcd:abcd:abcd:abcd:abcd:abcd:abcd:abcd'));
        self::assertTrue(Ip::isFormat('ABCD:ABCD:ABCD:ABCD:ABCD:ABCD:192.168.158.190'));

        self::assertFalse(Ip::isFormat('1'));
        self::assertFalse(Ip::isFormat('fiz'));
        self::assertFalse(Ip::isFormat('255.255.255.256'));
    }

    public function testLengthConstraint(): void
    {
        self::assertSame(2, Ip::getMinLength());
        self::assertSame(45, Ip::getMaxLength());
    }
}