<?php

namespace ProjxIO\Container;

interface Collection extends ItemContainer, Map, Set
{
    /**
     * @return Collection
     */
    public function keys();

    /**
     * @return Collection
     */
    public function values();

    /**
     * @return Collection
     */
    public function unique();

    /**
     * @param array|Collection $items
     * @return Collection
     */
    public function intersect($items = []);

    /**
     * @param array|Collection $items
     * @return Collection
     */
    public function difference($items = []);

    /**
     * @param array|Collection $items
     * @return Collection
     */
    public function concat($items = []);

    /**
     * @param array|Collection $keys
     * @return Collection
     */
    public function select($keys = []);

    /**
     * @param array|Collection $keys
     * @return Collection
     */
    public function exclude($keys = []);

    /**
     * @param callable $callback
     * @return $this
     */
    public function each(callable $callback);

    /**
     * @param callable $callback
     * @return Collection
     */
    public function map(callable $callback);

    /**
     * @param callable $map
     * @param callable $filter
     * @return Collection
     */
    public function mapFilter(callable $map, callable $filter);

    /**
     * @param callable $filter
     * @param callable $map
     * @return Collection
     */
    public function filterMap(callable $filter, callable $map);

    /**
     * @param callable $callback
     * @return Collection
     */
    public function filter(callable $callback);

    /**
     * @param callable $callback
     * @return Collection
     */
    public function sort(callable $callback);

    /**
     * @param callable $map
     * @param callable $sort
     * @return Collection
     */
    public function mapSort(callable $map, callable $sort);

    /**
     * @param callable $callback
     * @return Collection
     */
    public function group(callable $callback);

    /**
     * @param callable $callback
     * @return Collection
     */
    public function rename(callable $callback);
}
