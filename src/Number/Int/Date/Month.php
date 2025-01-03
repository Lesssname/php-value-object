<?php
declare(strict_types=1);

namespace LessValueObject\Number\Int\Date;

use LessValueObject\Number\Int\AbstractIntValueObject;

/**
 * @psalm-immutable
 */
final class Month extends AbstractIntValueObject
{
    /**
     * @psalm-pure
     */
    public static function getMinimumValue(): int
    {
        return 1;
    }

    /**
     * @psalm-pure
     */
    public static function getMaximumValue(): int
    {
        return 12;
    }
}
