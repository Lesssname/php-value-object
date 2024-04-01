<?php
declare(strict_types=1);

namespace LessValueObject\Composite;

use ArrayAccess;
use RuntimeException;

/**
 * @psalm-immutable
 *
 * @implements ArrayAccess<string, mixed>
 */
final class DynamicCompositeValueObject extends AbstractCompositeValueObject implements ArrayAccess
{
    /**
     * @param array<string, mixed> $data
     */
    public function __construct(public readonly array $data)
    {}

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    public function get(string $key): mixed
    {
        if (!$this->has($key)) {
            throw new RuntimeException();
        }

        return $this->data[$key];
    }

    /**
     * @return array<string, mixed>
     */
    public function export(): array
    {
        return $this->data;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->data;
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new RuntimeException('Immutable object');
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new RuntimeException('Immutable object');
    }
}
