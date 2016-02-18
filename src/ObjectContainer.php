<?php

namespace ProjxIO\Container;

use stdClass;

class ObjectContainer implements Container
{
    /**
     * @var stdClass
     */
    private $items;

    /**
     * @param stdClass $items
     */
    public function __construct(stdClass $items = null)
    {
        $this->items = $items ?: (object)[];
    }

    /**
     * @inheritDoc
     */
    public function items()
    {
        return (array)$this->items;
    }

    /**
     * @inheritDoc
     */
    public function put($key, $value)
    {
        $this->items->{$key} = $value;
    }

    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        unset($this->items->{$key});
    }
}
