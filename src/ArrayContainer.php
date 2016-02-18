<?php

namespace ProjxIO\Container;

class ArrayContainer extends ArrayReferenceContainer
{
    /**
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        parent::__construct($items);
    }
}
