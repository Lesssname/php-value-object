<?php
declare(strict_types=1);

namespace LessValueObject\String\Exception;

use LessValueObject\Exception\AbstractValueObjectException;

/**
 * @psalm-immutable
 */
final class TooLong extends AbstractValueObjectException
{
    public function __construct(public int $maximal, public int $given)
    {
        parent::__construct("Maximal {$maximal} characters allowed, given {$given}");
    }
}