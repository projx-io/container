<?php

namespace ProjxIO\Container;

interface Map extends Container
{
    /**
     * @param mixed $key
     * @return boolean
     */
    public function has($key);

    /**
     * @param mixed $key
     * @return mixed
     */
    public function get($key);
}
