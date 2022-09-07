<?php
namespace Fw\Core\Type;

use ArrayIterator;

class Dictionary implements
    \IteratorAggregate,
    \ArrayAccess,
    \Countable
{
    private array $data;

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this);
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->data['offset'];
        } else {
            throw new \Exception("Offset doesn't exist.");
        }
    }

    public function offsetSet($offset, $value): void
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->data['offset']);
    }

    public function count(): int
    {
        return count($this->data);
    }
}