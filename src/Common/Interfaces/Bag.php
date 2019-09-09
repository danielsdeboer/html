<?php

namespace Aviator\Html\Common\Interfaces;

use Aviator\Html\Common\Interfaces\Renderable;

interface Bag
{
    /**
     * Get a baggable item by name.
     * @param string $name
     * @return mixed
     */
    public function get ($name);

    /**
     * Add a baggable item.
     * @param $item
     * @return void
     */
    public function add (Renderable $item);

    /**
     * Add many baggable items.
     * @param array $items
     * @return mixed
     */
    public function many (array $items);
}
