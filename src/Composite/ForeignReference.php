<?php
declare(strict_types=1);

namespace LessValueObject\Composite;

use LessValueObject\Composite\Exception\CannotParseReference;
use LessValueObject\String\Exception\TooLong;
use LessValueObject\String\Exception\TooShort;
use LessValueObject\String\Format\Exception\NotFormat;
use LessValueObject\String\Format\Resource\Identifier;
use LessValueObject\String\Format\Resource\Type;

/**
 * @psalm-immutable
 */
final class ForeignReference extends AbstractCompositeValueObject
{
    /**
     * @psalm-pure
     */
    public function __construct(public readonly Type $type, public readonly Identifier $id)
    {}

    /**
     * @psalm-pure
     *
     * @throws TooShort
     * @throws NotFormat
     * @throws TooLong
     * @throws CannotParseReference
     */
    public static function fromString(string $string): self
    {
        $parts = explode('/', $string);

        if (count($parts) !== 2) {
            throw new CannotParseReference($string);
        }

        return new self(new Type($parts[0]), new Identifier($parts[1]));
    }

    /**
     * @param array{type: string, id: string} $array
     *
     * @psalm-pure
     *
     * @throws TooShort
     * @throws NotFormat
     * @throws TooLong
     */
    public static function fromArray(array $array): self
    {
        return new self(new Type($array['type']), new Identifier($array['id']));
    }

    public function __toString(): string
    {
        return "{$this->type}/{$this->id}";
    }
}
