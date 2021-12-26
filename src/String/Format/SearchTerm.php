<?php
declare(strict_types=1);

namespace LessValueObject\String\Format;

use LessValueObject\String\Format\Reference\Id;

/**
 * @psalm-immutable
 */
final class SearchTerm extends AbstractRegexpFormattedStringValueObject
{
    /**
     * @psalm-pure
     */
    public static function getRegexPattern(): string
    {
        return '^.*[a-zA-Z0-9].*$';
    }

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
        return 50;
    }

    public function isEmailAddress(): bool
    {
        return EmailAddress::isFormat((string)$this);
    }

    public function isReferenceId(): bool
    {
        return Id::isFormat((string)$this);
    }
}
