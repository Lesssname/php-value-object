<?php
declare(strict_types=1);

namespace LessValueObject\String;

/**
 * @psalm-immutable
 */
final class UtmParameter extends AbstractStringValueObject
{
    /**
     * @psalm-pure
     */
    public static function getMinLength(): int
    {
        return 1;
    }

    /**
     * @psalm-pure
     */
    public static function getMaxLength(): int
    {
        return 100;
    }
}