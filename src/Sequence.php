<?php

namespace ProjxIO\Container;

interface Sequence extends ItemContainer
{
    /**
     * @param mixed $value
     * @return boolean
     */
    public function contains($value);

    /**
     * @param integer $index
     * @return mixed
     */
    public function at($index);

    /**
     * @param mixed $value
     * @return integer
     */
    public function indexOf($value);
}
