<?php
declare(strict_types=1);

namespace LessValueObject\String\Format;

use LessValueObject\String\StringValueObject;

/**
 * @psalm-immutable
 *
 * @deprecated use StringFormatValueObject
 */
interface FormattedStringValueObject extends StringValueObject
{
    /**
     * @psalm-pure
     */
    public static function isFormat(string $input): bool;
}
