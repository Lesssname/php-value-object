<?php
declare(strict_types=1);

namespace LessValueObject\String\Format;

/**
 * @psalm-immutable
 */
final class Uri extends AbstractFormattedStringValueObject
{
    /**
     * @psalm-pure
     */
    public static function isFormat(string $input): bool
    {
        $length = self::getStringLength($input);

        if ($length < self::getMinLength() || $length > self::getMaxLength()) {
            return false;
        }

        return filter_var($input, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * @psalm-pure
     */
    public static function getMinLength(): int
    {
        return 5;
    }

    /**
     * @psalm-pure
     */
    public static function getMaxLength(): int
    {
        return 999;
    }
}
