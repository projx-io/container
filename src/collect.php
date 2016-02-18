<?php

use ProjxIO\Container\ArrayContainer;
use ProjxIO\Container\Collection;
use ProjxIO\Container\ContainerCollection;
use ProjxIO\Container\ObjectContainer;

if (!function_exists('collect')) {
    /**
     * @param array $items
     * @return Collection
     */
    function collect($items = [])
    {
        if ($items === null) {
            $items = [];
        }

        if ($items instanceof Collection) {
            return $items;
        }

        $items = is_object($items) ? new ObjectContainer($items) : new ArrayContainer($items);

        return new ContainerCollection($items);
    }
}
