<?php
declare(strict_types=1);

namespace LessValueObject\Number\Int\Paginate;

use LessValueObject\Number\Int\AbstractIntValueObject;

/**
 * @psalm-immutable
 */
final class PerPage extends AbstractIntValueObject
{
    /**
     * @psalm-pure
     */
    public static function getMinValue(): int
    {
        return 0;
    }

    /**
     * @psalm-pure
     */
    public static function getMaxValue(): int
    {
        return 100;
    }
}