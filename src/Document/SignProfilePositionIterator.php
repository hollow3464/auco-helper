<?php

namespace Hollow3464\AucoHelper\Document;

use ArrayAccess;
use Iterator;
use JsonSerializable;
use Serializable;

/** @implements Iterator<int, SignProfilePosition> */
class SignProfilePositionIterator implements ArrayAccess, Iterator, Serializable, JsonSerializable
{
    /** @var SignProfilePosition[] $items */
    private array $items = [];
    private int $current_index = 0;

    public function jsonSerialize(): array
    {
        return $this->items;
    }

    public function add(SignProfilePosition $value): static
    {
        $this->items[] = $value;
        return $this;
    }

    public function remove(int $index)
    {
        if ($index == $this->current_index) {
            $this->current_index = $index - 1;
        }

        $this->offsetUnset($index);

        return $this;
    }

    public function removeLast()
    {
        $this->offsetUnset(count($this->items) - 1);

        return $this;
    }


    public function current(): ?SignProfilePosition
    {
        return $this->items[$this->current_index];
    }

    public function next(): void
    {
        $this->current_index = $this->current_index + 1;
    }

    public function key(): int
    {
        return $this->current_index;
    }

    public function valid(): bool
    {
        return $this->offsetExists($this->current_index);
    }

    public function rewind(): void
    {
        $this->current_index = 0;
    }

    public function offsetExists(mixed $offset): bool
    {
        if (!is_numeric($offset)) {
            return false;
        }

        if (!($offset >= 0 && $offset < count($this->items))) {
            return false;
        }

        return true;
    }

    public function offsetGet(mixed $offset): SignProfilePosition
    {
        if (!is_numeric($offset)) {
            throw new \InvalidArgumentException("The offset must be an integer");
        }

        return $this->items[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!is_numeric($offset)) {
            throw new \InvalidArgumentException("The offset must be an integer");
        }

        if ($value::class !== SignProfilePosition::class) {
            throw new \InvalidArgumentException("The value must be a valid SignProfilePosition");
        }

        $this->items[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        if (!$this->offsetExists($offset)) {
            throw new \InvalidArgumentException("The offset value is not valid");
        }

        unset($this->items[$offset]);
    }

    public function serialize(): string
    {
        return json_encode($this->items);
    }

    public function unserialize(string $data): static
    {
        $data = json_decode($data, true);

        if (!array_is_list($data)) {
            throw new \InvalidArgumentException();
        }

        $this->items = array_map(
            fn($d) => new SignProfilePosition(
                $d['page'], $d['x'], $d['y'], $d['w'], $d['h']
            ),
            $data
        );

        return clone $this;
    }

    public function __serialize(): array
    {
        return $this->items;
    }

    public function __unserialize(array $data): void
    {
        $this->items = $data;
    }
}