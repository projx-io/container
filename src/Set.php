<?php

namespace ProjxIO\Container;

interface Set extends Sequence
{
    /**
     * @param mixed $value
     * @return $this
     */
    public function add($value);

    /**
     * @param integer $index
     * @param mixed $value
     * @return $this
     */
    public function set($index, $value);

    /**
     * @param mixed $value
     * @return $this
     */
    public function remove($value);
}