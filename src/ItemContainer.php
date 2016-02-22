<?php

namespace ProjxIO\Container;

use JsonSerializable;

interface ItemContainer extends JsonSerializable
{
    /**
     * @return array
     */
    public function items();
}