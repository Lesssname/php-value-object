<?php
declare(strict_types=1);

namespace LessValueObject\String\Format;

/**
 * @psalm-immutable
 */
final class Ip extends AbstractFormattedStringValueObject
{
    /**
     * @psalm-pure
     */
    public static function isFormat(string $input): bool
    {
        $length = mb_strlen($input);

        if ($length < static::getMinLength() || $length > static::getMaxLength()) {
            return false;
        }

        return filter_var($input, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * @psalm-pure
     */
    public static function getMinLength(): int
    {
        return 2;
    }

    /**
     * @psalm-pure
     */
    public static function getMaxLength(): int
    {
        return 45;
    }
}