<?php
declare(strict_types=1);

namespace LessValueObject\Number\Int;

use LessValueObject\Number\NumberValueObject;
use LessValueObject\Number\Exception\MinOutBounds;
use LessValueObject\Number\Exception\MaxOutBounds;
use LessValueObject\Number\Exception\NotMultipleOf;

/**
 * @psalm-immutable
 *
 * @phpstan-consistent-constructor
 */
abstract class AbstractIntValueObject implements IntValueObject
{
    /**
     * @throws MaxOutBounds
     * @throws MinOutBounds
     * @throws NotMultipleOf
     */
    public function __construct(public readonly int $value)
    {
        if ($value < static::getMinimumValue()) {
            throw new MinOutBounds(static::getMinimumValue(), $value);
        }

        if ($value > static::getMaximumValue()) {
            throw new MaxOutBounds(static::getMaximumValue(), $value);
        }

        if ($value % static::getMultipleOf() !== 0) {
            throw new NotMultipleOf($value, static::getMultipleOf());
        }
    }

    public static function getMultipleOf(): int|float
    {
        return 1;
    }

    /**
     * @deprecated
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function jsonSerialize(): float | int
    {
        return $this->value;
    }

    public function isGreaterThan(NumberValueObject|float|int $value): bool
    {
        return $this->getValue() > $this->getUsableValue($value);
    }

    public function isLowerThan(NumberValueObject|float|int $value): bool
    {
        return $this->getValue() < $this->getUsableValue($value);
    }

    public function isSame(NumberValueObject|float|int $value): bool
    {
        return $this->getUsableValue($value) === $this->getValue();
    }

    public function diff(NumberValueObject|float|int $with): float|int
    {
        if ($with instanceof NumberValueObject) {
            $with = $with->value;
        }

        return $with - $this->value;
    }

    /**
     * @throws MaxOutBounds
     * @throws MinOutBounds
     * @throws NotMultipleOf
     */
    public function subtract(NumberValueObject|float|int $value): static
    {
        return new static($this->value - $this->getUsableValue($value));
    }

    /**
     * @throws MaxOutBounds
     * @throws MinOutBounds
     * @throws NotMultipleOf
     */
    public function append(NumberValueObject|float|int $value): static
    {
        return new static($this->value + $this->getUsableValue($value));
    }

    protected function getUsableValue(NumberValueObject|float|int $value): float | int
    {
        if (is_float($value) || is_int($value)) {
            return $value;
        }

        return $value->value;
    }

    /**
     * @psalm-pure
     */
    abstract public static function getMinimumValue(): int;

    /**
     * @psalm-pure
     */
    abstract public static function getMaximumValue(): int;
}
