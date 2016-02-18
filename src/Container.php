<?php

namespace ProjxIO\Container;

interface Container extends ItemContainer
{
    /**
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function put($key, $value);

    /**
     * @param mixed $key
     * @return void
     */
    public function delete($key);
}
