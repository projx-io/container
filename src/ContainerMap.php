<?php

namespace ProjxIO\Container;

class ContainerMap implements Map
{
    /**
     * @var Container
     */
    private $items;

    /**
     * @param Container $items
     */
    public function __construct(Container $items)
    {
        $this->items = $items;
    }

    public function __get($key)
    {
        return $this->get($key);
    }

    public function __set($key, $value)
    {
        $this->put($key, $value);
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function items()
    {
        return $this->items->items();
    }

    /**
     * @inheritDoc
     */
    public function has($key)
    {
        return array_key_exists($key, $this->items());
    }

    /**
     * @inheritDoc
     */
    public function get($key)
    {
        $items = (array)$this->items();
        return $items[$key];
    }

    /**
     * @inheritDoc
     */
    public function put($key, $value)
    {
        $this->items->put($key, $value);
    }

    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        $this->items->delete($key);
    }

    /**
     * @inheritDoc
     */
    function jsonSerialize()
    {
        return $this->items();
    }
}
