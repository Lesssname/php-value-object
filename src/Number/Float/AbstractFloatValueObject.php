<?php
declare(strict_types=1);

namespace LessValueObject\Number\Float;

use LessValueObject\Number\NumberValueObject;
use LessValueObject\Number\Exception\MinOutBounds;
use LessValueObject\Number\Exception\MaxOutBounds;
use LessValueObject\Number\Exception\NotMultipleOf;

/**
 * @psalm-immutable
 *
 * @phpstan-consistent-constructor
 */
abstract class AbstractFloatValueObject implements NumberValueObject
{
    /**
     * @throws MaxOutBounds
     * @throws MinOutBounds
     * @throws NotMultipleOf
     */
    public function __construct(public readonly int | float $value)
    {
        if ($value < static::getMinimumValue()) {
            throw new MinOutBounds(static::getMinimumValue(), $value);
        }

        if ($value > static::getMaximumValue()) {
            throw new MaxOutBounds(static::getMaximumValue(), $value);
        }

        if (!static::isMultipleOf($value, static::getMultipleOf())) {
            throw new NotMultipleOf($value, static::getMultipleOf());
        }
    }

    /**
     * @psalm-pure
     */
    protected static function isMultipleOf(float | int $value, float | int $of): bool
    {
        if (is_int($value) && is_int($of) && $value % $of === 0) {
            return true;
        }

        if (is_float($of)) {
            $ofParts = explode('.', (string)$of);
            $precision = strlen($ofParts[1]);
            $of = (int)($ofParts[0] . $ofParts[1]);
            $power = pow(10, $precision);
        } else {
            $precision = 0;
            $power = 1;
        }

        if (is_float($value)) {
            $valueParts = explode('.', (string)$value);

            if (strlen($valueParts[1]) > $precision) {
                return false;
            } else {
                $float = str_pad($valueParts[1], $precision, '0');
                $check = (int)($valueParts[0] . $float);
            }
        } else {
            $check = $value * $power;
        }

        if ($check % $of !== 0) {
            return false;
        }

        return true;
    }

    /**
     * @deprecated
     */
    public function getValue(): float|int
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
}