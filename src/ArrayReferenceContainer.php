<?php

namespace ProjxIO\Container;

class ArrayReferenceContainer implements Container
{
    /**
     * @var array
     */
    private $items;

    /**
     * @param array $items
     */
    public function __construct(array &$items = [])
    {
        $this->items = &$items;
    }

    /**
     * @inheritDoc
     */
    public function items()
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function put($key, $value)
    {
        $this->items[$key] = $value;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        unset($this->items[$key]);
        return $this;
    }

    /**
     * @inheritDoc
     */
    function jsonSerialize()
    {
        return $this->items();
    }
}
