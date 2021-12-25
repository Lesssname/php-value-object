<?php
declare(strict_types=1);

namespace LessValueObjectTest\Number\Int\Date;

use DateTime;
use LessValueObject\Number\Int\Date\MilliTimestamp;
use PHPUnit\Framework\TestCase;

/**
 * @covers \LessValueObject\Number\Int\Date\MilliTimestamp
 */
final class MilliTimestampTest extends TestCase
{
    public function testFromDateTime(): void
    {
        $date = new DateTime();
        $timestamp = MilliTimestamp::fromDateTime($date);

        self::assertSame($date->format('U.v'), $timestamp->format('U.v'));
    }

    public function testNow(): void
    {
        $datetime = MilliTimestamp::fromDateTime(new DateTime());
        $now = MilliTimestamp::now();

        $diff = abs($now->getValue() - $datetime->getValue());

        // Allow for 1 ms leeway
        self::assertTrue($diff <= 1);
    }

    public function testFormat(): void
    {
        $timestamp = new MilliTimestamp(123456);

        self::assertSame(
            '1970-01-01 00:02:03.456',
            $timestamp->format('Y-m-d H:i:s.v'),
        );
    }

    public function testToMilliTimestamp(): void
    {
        $timestamp = new MilliTimestamp(654321);

        $timestmap = $timestamp->toTimestamp();

        self::assertSame(654, $timestmap->getValue());
    }
}