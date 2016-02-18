<?php

namespace ProjxIO\Container;

class ContainerCollection extends ContainerMap implements Collection
{
    public function __construct(Container $items = null)
    {
        parent::__construct($items ?: new ArrayReferenceContainer());
    }

    /**
     * @inheritDoc
     */
    public function keys()
    {
        return new ContainerCollection(new ArrayReferenceContainer(array_keys($this->items())));
    }

    /**
     * @inheritDoc
     */
    public function values()
    {
        return new ContainerCollection(new ArrayReferenceContainer(array_values($this->items())));
    }

    /**
     * @inheritDoc
     */
    public function unique()
    {
        return new ContainerCollection(new ArrayReferenceContainer(array_unique($this->items())));
    }

    /**
     * @inheritDoc
     */
    public function intersect($items = [])
    {
        return new ContainerCollection(new ArrayReferenceContainer(array_intersect($this->items(), $items)));
    }

    /**
     * @inheritDoc
     */
    public function difference($items = [])
    {
        return new ContainerCollection(new ArrayReferenceContainer(array_diff($this->items(), $items)));
    }

    /**
     * @inheritDoc
     */
    public function concat($items = [])
    {
        return new ContainerCollection(new ArrayReferenceContainer(array_merge($this->items(), $items)));
    }

    /**
     * @inheritDoc
     */
    public function select($keys = [])
    {
        return (new ContainerCollection(new ArrayReferenceContainer($keys)))
            ->rename(function ($key) {
                return $key;
            })
            ->map(function ($key) {
                return $this->has($key) ? $this->get($key) : null;
            });
    }

    /**
     * @inheritDoc
     */
    public function exclude($keys = [])
    {
        $keys = array_flip($keys);
        $items = array_diff_key($this->select($keys)->items(), $keys);
        $items = array_merge($keys, $items);
        return new ContainerCollection(new ArrayReferenceContainer($items));
    }

    /**
     * @inheritDoc
     */
    public function each(callable $callback)
    {
        $index = 0;
        foreach ($this->items() as $key => $value) {
            call_user_func($callback, $value, $key, $index++);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function map(callable $callback)
    {
        $index = 0;
        $items = new ContainerCollection(new ArrayReferenceContainer());
        foreach ($this->items() as $key => $value) {
            $items->put($key, call_user_func($callback, $value, $key, $index++));
        }
        return $items;
    }

    /**
     * @inheritDoc
     */
    public function mapFilter(callable $map, callable $filter)
    {
        return $this->select($this->map($map)->filter($filter)->keys()->items());
    }

    /**
     * @inheritDoc
     */
    public function filterMap(callable $filter, callable $map)
    {
        return $this->map(function ($value) use ($filter, $map) {
            return call_user_func_array($filter, func_get_args()) ? call_user_func_array($map, func_get_args()) : $value;
        });
    }

    /**
     * @inheritDoc
     */
    public function filter(callable $callback)
    {
        $index = 0;
        $items = new ContainerCollection(new ArrayReferenceContainer());
        foreach ($this->items() as $key => $value) {
            if (call_user_func($callback, $value, $key, $index++)) {
                $items->put($key, $value);
            }
        }
        return $items;
    }

    /**
     * @inheritDoc
     */
    public function sort(callable $callback)
    {
        $items = $this->items();
        uasort($items, $callback);
        return new ContainerCollection(new ArrayReferenceContainer($items));
    }

    /**
     * @inheritDoc
     */
    public function mapSort(callable $map, callable $sort)
    {
        return $this->select($this->map($map)->sort($sort)->keys()->items());
    }

    /**
     * @inheritDoc
     */
    public function group(callable $callback)
    {
        $keys = $this->map($callback);
        $groups = $keys->unique()
            ->rename(function ($key) {
                return $key;
            })
            ->map(function () {
                return new ContainerCollection(new ArrayReferenceContainer());
            });

        $keys->each(function ($group, $key) use ($groups) {
            $groups->get($group)->put($key, $this->get($key));
        });

        return $groups;
    }

    /**
     * @inheritDoc
     */
    public function rename(callable $callback)
    {
        $index = 0;
        $items = new ContainerCollection(new ArrayReferenceContainer());
        foreach ($this->items() as $key => $value) {
            $items->put(call_user_func($callback, $value, $key, $index++), $value);
        }
        return $items;
    }

    /**
     * @inheritDoc
     */
    public function contains($value)
    {
        return array_search($value, $this->items()) !== false;
    }

    /**
     * @inheritDoc
     */
    public function at($index)
    {
        return $this->values()->get($index);
    }

    /**
     * @inheritDoc
     */
    public function indexOf($value)
    {
        return array_search($value, $this->values()->items());
    }

    /**
     * @inheritDoc
     */
    public function add($value)
    {
        $items = $this->items();
        array_push($items, $value);
        $keys = array_keys($items);
        $key = array_pop($keys);
        $this->put($key, $value);
    }

    /**
     * @inheritDoc
     */
    public function set($index, $value)
    {
        $this->put($this->keys()->get($this->indexOf($value)), $value);
    }

    /**
     * @inheritDoc
     */
    public function remove($value)
    {
        $this->delete($this->keys()->get($this->indexOf($value)));
    }
}
